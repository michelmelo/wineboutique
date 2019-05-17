<?php

namespace App\Http\Controllers;

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
        $this->receiptPageURL = url("/checkout/complete");
        $this->orderId = $this->generateUniqueOrderId();
        $this->requestDateTime = $this->requestDateTime();
        $this->validationURL = url("/checkout/validate");
        $this->authHash = $this->authRequestHash();
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

    private function authRequestHash() {
        return md5($this->terminalId . $this->orderId . $this->amount . $this->requestDateTime . $this->receiptPageURL . $this->validationURL . $this->secret);
    }

    private function authResponseHashIsValid($orderId, $amount, $dateTime, $responseCode, $responseText, $responseHash) {
        return (md5($this->terminalId . $orderId . $amount . $dateTime . $responseCode . $responseText . $this->secret)==$responseHash);
    }

    public function get()
    {
        $this->amount = Auth::user()->cart->reduce(function($carry, $item) {
            return $carry + $item->price * $item->pivot->quantity;
        }, 0);
        return view('checkout', [
            'gateway' => config('payment.nuvei.gateway'),
            'terminalId' => config('payment.nuvei.terminalId'),
            'currency' => config('payment.nuvei.currency'),
            'secret' => config('payment.nuvei.secret'),
            'testAccount' => config('payment.nuvei.testAccount'),
            'receiptPageURL' => $this->receiptPageURL,
            'orderId' => $this->generateUniqueOrderId(),
            'requestDateTime' => $this->requestDateTime(),
            'validationURL' => $this->validationURL,
            'authHash' => $this->authRequestHash(),
            'requestURL' => $this->requestURL(),
            'amount' => $this->amount
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

    public function complete()
    {
        $response = "";
        if($this->authResponseHashIsValid($_REQUEST["ORDERID"], $_REQUEST["AMOUNT"], $_REQUEST["DATETIME"], $_REQUEST["RESPONSECODE"], $_REQUEST["RESPONSETEXT"], $_REQUEST["HASH"])) {
            switch($_REQUEST["RESPONSECODE"]) {
                case "A" :	# -- If using local database, update order as Paid/Successful
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
    }
}
