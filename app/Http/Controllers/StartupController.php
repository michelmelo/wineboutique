<?php

namespace App\Http\Controllers;

use App\Http\Requests\StartupRequest;
use App\WineryPayment;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Region;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;


class StartupController extends Controller
{
    public function show()
    {
        $winery = Auth::user()->winery;

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

        return redirect()->route('sub-merchant-setup');
    }

    public function show_payment()
    {
        return view('payment_setup', []);
    }

    public function store_payment(Request $request)
    {
        $user= Auth::user();

        $ssn = $request->ssn;
        $webpage = $request->webpage;

        if(!$ssn || !$webpage){
            return redirect("sellOnModa")->with('message', 'Missing data');
        }

        $dob_obj = getdate(strtotime($user->birthday));

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
                "business_profile" => [
                    "url" => $webpage
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
        catch (\Exception $e){
            return redirect()->back()->with('message', 'Something went wrong.');
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
