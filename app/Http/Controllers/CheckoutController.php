<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\OrderWine;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    private $gateway, $terminalId, $currency, $secret, $testAccount, $receiptPageURL, $orderId, $requestDateTime, $validationURL, $authHash, $amount;

    public function __construct()
    {
        $this->gateway = config('payment.nuvei.gateway');
        $this->terminalId = config('payment.nuvei.terminalId');
        $this->currency = config('payment.nuvei.currency');
        $this->secret = config('payment.nuvei.secret');
        $this->testAccount = config('payment.nuvei.testAccount');
        $this->orderId = $this->generateUniqueOrderId();
        $this->requestDateTime = $this->requestDateTime();
        $this->validationURL = url("/checkout/validate");
        $this->receiptPageURL = url("/checkout/complete", ["order_id" => $this->orderId]);
    }

    private function generateUniqueOrderId() {
        $seconds = date('H')*3600+date('i')*60+date('s');
        return date('zy') . $seconds;
    }

    private function requestDateTime() {
        return date('d-m-Y:H:i:s:000');
    }

    private function requestURL() {
        $gateway =  config('payment.nuvei.gateway'); 
        $testAccount = config('payment.nuvei.testAccount');
        $url = 'https://';
        if($testAccount) $url .= 'test';
        switch (strtolower($gateway)) {
            case 'cashflows' : $url .= 'cashflows.nuvei.com'; break;
            case 'payius' : $url .= 'payments.payius.com'; break;
            default :
            case 'nuvei'  : $url .= 'payments.nuvei.com'; break;
        }
        $url .= '/merchant/paymentpage';
        return $url;
    }

    private function authRequestHash($orderId, $amount, $dateTime, $receiptPageURL, $validationURL, $secret) {
        return hash("sha512", $this->terminalId . ":" . $orderId . ":" .  $amount . ":" .  $dateTime . ":" . $receiptPageURL . ":" . $validationURL . ":" . $secret);
    }

    private function authResponseHashIsValid($orderId, $amount, $dateTime, $responseCode, $responseText, $responseHash) {
        return (hash("sha512", $this->terminalId . ":" . $orderId . ":" . $amount . ":" . $dateTime . ":" . $responseCode . ":" . $responseText . ":" . $this->secret) == $responseHash);
    }

    public function get()
    {
        $wines = Auth::user()->cart;
        $user_default_region = Auth::user()->addresses()->where("default", 1)->first();

        if($user_default_region){
            foreach ($wines as $wine){
                foreach ($wine->winery->winery_shippings as $shipping){
                    if($user_default_region->region_id == $shipping->ship_to){
                        $wine->shipping_price = $shipping->price;
                        $wine->shipping_additional = $shipping->additional;

                        break;
                    }
                }
            }
        }

        $this->amount = $wines->reduce(function($carry, $item) {
            return number_format($carry + ($item->price * $item->pivot->quantity) + $item->shipping_price +
                ($item->shipping_additional * ($item->pivot->quantity - 1)), 2);
        }, 0);

        return view('checkout', [
            'gateway' => $this->gateway,
            'terminalId' => $this->terminalId,
            'currency' => $this->currency,
            'secret' => $this->secret,
            'testAccount' => $this->testAccount,
            'orderId' => $this->orderId,
            'requestDateTime' => $this->requestDateTime,
            'validationURL' => $this->validationURL,
            'receiptPageURL' => $this->receiptPageURL,
            'requestURL' => $this->requestURL(),
            'amount' => $this->amount,
            'authHash' => $this->authRequestHash($this->orderId, $this->amount, $this->requestDateTime, $this->receiptPageURL, $this->validationURL, $this->secret)
        ]);
    }

    public function validateHash(Request $request)
    {
        if($this->authResponseHashIsValid($request->input("ORDERID"), $request->input("AMOUNT"), $request->input("DATETIME"), $request->input("RESPONSECODE"), $request->input("RESPONSETEXT"), $request->input("HASH"))) {
            if($request->has("ORDERID")) {
                switch($request->input("RESPONSECODE")) {
                    case "A" :	# -- Update order in database as paid/sucessful --
                            echo 'OK';
                            break;
                    case "R" :
                    case "D" :
                    case "C" :
                    default  :	# -- Update order in database as declined/failed --
                            echo 'OK';
                }
            } else {
                echo 'Order ID: ' . $request->input("ORDERID") . ' not found.';
            }
        }
    }

    public function complete($order_id)
    {
        $response = "";

        if($this->authResponseHashIsValid($_REQUEST["ORDERID"], $_REQUEST["AMOUNT"], $_REQUEST["DATETIME"], $_REQUEST["RESPONSECODE"], $_REQUEST["RESPONSETEXT"], $_REQUEST["HASH"])) {
            switch($_REQUEST["RESPONSECODE"]) {
                case "A" :	# -- If using local database, update order as Paid/Successful
                        $new_order = new Order();
                        $new_order->order_id = $_REQUEST["ORDERID"];
                        $new_order->user_id = Auth::user()->id;
                        $new_order->address_id = Auth::user()->addresses->where("default", 1)->first()->id;
                        $new_order->status = 1;

                        if($new_order->save()){
                            foreach (Auth::user()->cart()->get() as $item){
                                $new_order_wine = new OrderWine();
                                $new_order_wine->order_id = $new_order->id;
                                $new_order_wine->wine_id = $item->pivot->wine_id;
                                $new_order_wine->quantity = $item->pivot->quantity;

                                if($new_order_wine->save()){
                                    Auth::user()->cart()->detach($new_order_wine->wine_id);
                                }
                            }
                        }

                        $response = 'Payment Processed successfully. Thanks you for your order.';
                        break;
                case "R" :
                case "D" :
                case "C" :
                case "S" :
                default  :	# -- If using local database, update order as declined/failed --
                    $response = 'PAYMENT DECLINED! Please try again with another card. Bank response: ' . $_REQUEST["RESPONSETEXT"];
            }
        } else {
            $response = 'PAYMENT FAILED.';
        }

        return view('complete', [
            'response' => $response
        ]);
    }
}
