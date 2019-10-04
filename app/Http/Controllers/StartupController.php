<?php

namespace App\Http\Controllers;

use App\Http\Requests\StartupRequest;
use App\UserPayment;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Region;


class StartupController extends Controller
{
    public function show()
    {
        $winery = Auth::user()->winery;

        if(!$winery){
            return redirect("/");
        }

        return view('startup', [
            'winery' => $winery,
            'winery_regions' => $this->onlyIDs($winery->regions),
            'regions' => Region::orderBy('name')->get()
        ]);
    }

    public function store(StartupRequest $request)
    {
        $winery = Auth::user()->winery;

        $winery->name = $request->wineryName;
        $winery->description = $request->description;
        $winery->save();

        $winery->regions()->attach($request->regions);

        foreach($request->shipping as $shippings) {
            $do_save = true;

            foreach ($shippings as $shipping){
                if(is_null($shipping)){
                    $do_save = false;
                }
            }

            if($do_save){
                if(isset($shippings['shipping_free'])){
                    $shippings['price'] = 0;
                    $shippings['additional'] = 0;
                    unset($shippings['shipping_free']);
                }

                $winery->winery_shippings()->create($shippings);
            }
        }

        $user= Auth::user();
        $ssn = $request->ssn;
        $dob_obj = getdate(strtotime($user->birthday));

        if(!$ssn){
            return redirect("sellOnModa")->with('message', 'Missing data');
        }

        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_PRIVATE_KEY'));

            $account = \Stripe\Account::create([
                'country' => 'US',
                'type' => 'custom',
                'business_type' => 'individual',
                'email' => $user->email,
                'requested_capabilities' => ['transfers'],
                "individual" => [
                    "first_name" => $user->firstName,
                    "last_name" => $user->lastName,
                    "ssn_last_4" => $ssn,
                    "dob" => [
                        "day" => $dob_obj["mday"],
                        "month" => $dob_obj["mon"],
                        "year" => $dob_obj["year"],
                    ],
                ],
                "tos_acceptance" => [
                    "date" => time(),
                    "ip" => $request->ip()
                ]
            ]);

            $data=[
                "stripe_id" => $account->id
            ];

            $user->winery()->update($data);

        }
        catch (Exception $e){
            return redirect()->back()->with('message', 'Something went wrong.');
        }

        $stripe = \Stripe\Customer::create([
            "email" => Auth::user()->email,
            "source" => $request->stripeToken
        ]);

        if($stripe){
            $user_payment = new UserPayment();
            $user_payment->user_id = Auth::user()->id;
            $user_payment->stripe_customer_id = $stripe->id;
            $user_payment->stripe_card_id = !is_null($stripe->default_source) ? $stripe->default_source : "";
            $user_payment->alias = $request->alias;
            $user_payment->is_default = true;

            $user_payment->save();

            UserPayment::where("id", "!=", $user_payment->id)->where("user_id", $user->id)->update(["is_default" => 0]);

        }

        return redirect()->route('my-winery')->with('message', 'Application sent.');
    }

    private function onlyIDs($obj)
    {
        $retVal = array();
        foreach ($obj as $item) {
            array_push($retVal,$item->id);
        }
        return $retVal;
    }
}
