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
        $winery = Auth::user()->winery;
        $client = new Client();
        $fields = array();

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
            $res = json_decode($res->getBody());

            $fields = $res->CustomFields;

            foreach ($fields as $key => $value){
                if(!$value->IsRequired){
                    unset($fields[$key]);
                }
            }
        } else {
            dd("Temlate: " . $res->getStatusCode());
        }

        return view('payment_setup', [
            'winery' => $winery,
            'fields' => $fields,
            'custom_field_answers' => $res->MerchantApplicationTemplate->CustomFieldAnswers
        ]);
    }

    public function store_payment(Request $request)
    {
        $client = new Client();
        $winery = Auth::user()->winery;
        $params = $request->all();
        $req = array();

        unset($params["_token"]);

        foreach($params as $key => $value){
            if(is_string($value)){
                if(strpos($key,"dob") !== false){
                    $tmp_array = explode("-", $value);

                    $req[] = array(
                        "Id" => null,
                        "UserDefinedId" => str_replace("_", ".", $key),
                        "Value" => array(
                            "Year" => $tmp_array[0],
                            "Month" => $tmp_array[1],
                            "Day" => $tmp_array[2]
                        )
                    );
                }
                elseif(strpos($key,"clicktoagree") !== false){
                    $req[] = array(
                        "Id" => null,
                        "UserDefinedId" => str_replace("_", ".", $key),
                        "Value" => array(
                            "#" => true
                        )
                    );
                }
                else{
                    $req[] = array(
                        "Id" => null,
                        "UserDefinedId" => str_replace("_", ".", $key),
                        "Value" => array(
                            "#" => $value
                        )
                    );
                }
            }
            elseif(is_array($value)){
                $tmp_array = array();

                foreach ($value as $tmp_key => $tmp_value){
                    $tmp_array[$tmp_key] = $tmp_value;
                }

                $req[] = array(
                    "Id" => null,
                    "UserDefinedId" => str_replace("_", ".", $key),
                    "Value" => $tmp_array
                );
            }
        }

        $req[] = array(
            "Id" => null,
            "UserDefinedId" => "owner1.fullname",
            "Value" => array(
                "FirstName"=> $params["legal_name"],
                "MiddleName"=> "",
                "LastName"=> $params["legal_name"]
            )
        );

        $res = $client->post(
            'https://app.payfacconnect.com/wineboutique/api/v1/MerchantApplication/Submit',
            [
                'json' => [
                    'AuthenticationKeyId' => 'db1ca085-5bbb-4d12-8e2e-d78d21566b14',
                    'AuthenticationKeyValue' => 'lAq.ydR8oZ6Lk7MHsUAkawcHmid8UhjgkImpESN^aQfqIhmFONn-h7z~2tX-Fruq',
                    'Merchant_EmailAddress' => $params["owner1_email"],
                    'CustomFieldAnswers' => $req
                ]
            ]
        );

        if ($res->getStatusCode() == 200) {
            $body = json_decode($res->getBody());

            if ($body->Status == 30) {
                $winery_payment = new WineryPayment();

                $winery_payment->winery_id = $winery->id;
                $winery_payment->merchant_id = $body->MerchantApplicationId;
                $winery_payment->external_merchant_id = $body->ExternalMerchantApplicationId;
                $winery_payment->infinicept_application_id = $body->InfiniceptApplicationId;

                $winery_payment->save();

                return redirect()->route('my-winery');
            }
            else{
                dd($body);
                return redirect()->route('sub-merchant-setup');
            }
        } else {
            dd("Submit: " . $res->getStatusCode());
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
