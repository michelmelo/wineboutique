<?php

namespace App\Http\Controllers;

use App\Http\Requests\StartupRequest;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Region;


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
        $winery = Auth::user()->winery;

        return view('payment_setup', [
            'winery' => $winery
        ]);
    }

    public function store_payment()
    {
        $client = new Client();
        $res = $client->post(
            'https://app.payfacconnect.com/wineboutique/api/v1/MerchantApplication/Template',
            [
                'json' => [
                    'AuthenticationKeyId' => 'db1ca085-5bbb-4d12-8e2e-d78d21566b14',
                    'AuthenticationKeyValue' => 'lAq.ydR8oZ6Lk7MHsUAkawcHmid8UhjgkImpESN^aQfqIhmFONn-h7z~2tX-Fruq'
                ]
            ]
        );

        if ($res->getStatusCode() == 200) {
            $body = json_decode($res->getBody());

            $res = $client->post(
                'https://app.payfacconnect.com/wineboutique/api/v1/MerchantApplication/Submit',
                [
                    'json' => [
                        'AuthenticationKeyId' => 'db1ca085-5bbb-4d12-8e2e-d78d21566b14',
                        'AuthenticationKeyValue' => 'lAq.ydR8oZ6Lk7MHsUAkawcHmid8UhjgkImpESN^aQfqIhmFONn-h7z~2tX-Fruq',
                        'MerchantApplicationSubmission' => $body->MerchantApplicationTemplate
                    ]
                ]
            );

            if ($res->getStatusCode() == 200) {
                $body2 = json_decode($res->getBody());

                if ($body2->Status == 30) {
                    dd($body2);
                }
            } else {
                dd("Submit: " . $res->getStatusCode());
            }
        } else {
            dd("Temlate: " . $res->getStatusCode());
        }

        return redirect()->route('my-winery');
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
