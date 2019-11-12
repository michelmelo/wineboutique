<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\OrderWine;
use App\User;
use App\Wine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        return time();
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
            'hasPayment' => Auth::user()->payments()->first(),
            'requestDateTime' => $this->requestDateTime,
            'validationURL' => $this->validationURL,
            'receiptPageURL' => $this->receiptPageURL,
            'requestURL' => $this->requestURL(),
            'amount' => $this->amount,
            'authHash' => $this->authRequestHash($this->orderId, $this->amount, $this->requestDateTime, $this->receiptPageURL, $this->validationURL, $this->secret)
        ]);
    }

    public function complete()
    {
        $user = Auth::user();
        $cart = $user->cart;
        $user_default_region = Auth::user()->addresses()->where("default", 1)->first();
        $payment = $user->payments()->where("is_default" ,"=", 1)->first();

        if($user_default_region){
            foreach ($cart as $wine){
                foreach ($wine->winery->winery_shippings as $shipping){
                    if($user_default_region->region_id == $shipping->ship_to){
                        $wine->shipping_price = $shipping->price;
                        $wine->shipping_additional = $shipping->additional;

                        break;
                    }
                }
            }
        }

        $sum = $cart->reduce(function($carry, $item) {
            return number_format($carry + ($item->price * $item->pivot->quantity) + $item->shipping_price +
                ($item->shipping_additional * ($item->pivot->quantity - 1)), 2);
        }, 0);

        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_PRIVATE_KEY'));

            $charge = \Stripe\Charge::create([
                "amount" => $sum * 100,
                "currency" => "usd",
                "source" => $payment->stripe_card_id,
                "customer" => $payment->stripe_customer_id,
                "metadata" =>[
                    "order_id" => $this->orderId
                ]
            ]);
        }
        catch (\Exception $e){
            return redirect()->back();
        }

        $price = 0;
        $quantity = 0;

        if($charge && $charge->status == "succeeded"){
            $new_order = new Order();
            $new_order->order_id = (int)$this->orderId;
            $new_order->user_id = $user->id;
            $new_order->address_id = $user->addresses->where("default", 1)->first()->id;
            $new_order->status = "1";

            if($new_order->save()){
                foreach (Auth::user()->cart()->get() as $item){
                    $new_order_wine = new OrderWine();
                    $new_order_wine->order_id = $new_order->id;
                    $new_order_wine->wine_id = $item->pivot->wine_id;
                    $new_order_wine->quantity = $item->pivot->quantity;

                    $price += $item->pivot->quantity * $new_order_wine->wine()->first()->price;
                    $quantity += $item->pivot->quantity;

                    if($new_order_wine->save()){
                        Auth::user()->cart()->detach($new_order_wine->wine_id);
                        $temp_wine = Wine::where("id", $item->pivot->wine_id)->first();
                        $temp_wine->update(["quantity" => $temp_wine->quantity - 1]);

                        Mail::send('email.order-created', [
                            'order' => $new_order->order_id,
                            'wine' => $item->name,
                            'quantity' => $item->pivot->quantity,
                        ],
                            function ($message) use ($item)
                            {
                                $message
                                    ->from("no-reply@wineboutique.com")
                                    ->to($item->winery->user->email)->subject('New Order submited');
                            });
                    }
                }
            }
        }

        $address = Auth::user()->addresses()->where("default", 1)->first();

        $charged_shippings = [];
        foreach($new_order->order_wines as $order_wine) {
            $shipping = $order_wine->wine->winery->winery_shippings->where("ship_to", $address->region_id)->first();
            if(!in_array($shipping->id, $charged_shippings)) {
                $charged_shippings[] = $shipping->id;
                $price += $shipping->price;
                $price += ($order_wine->quantity - 1) * $shipping->additional;
            } else {
                $price += $order_wine->quantity * $shipping->additional;
            }
        }

        $new_order->update(['price' => $price]);

        $from_to = $new_order->order_wines[0]->wine->winery->winery_shippings->where("ship_to", $address->region_id)->first();

        Mail::send('email.order-confirmation', [
            'order' => $new_order->order_id,
            'from_to' => $from_to
        ],
        function ($message) use ($user)
        {
            $message
                ->from("no-reply@wineboutique.com")
                ->to($user->email)->subject('Order confirmation');
        });

        return redirect("/checkout/done/" . $new_order->id);
    }

    public function done(Order $order)
    {
        $address = Auth::user()->addresses()->where("default", 1)->first();
        $from_to = $order->order_wines[0]->wine->winery->winery_shippings->where("ship_to", $address->region_id)->first();

        return view('thank-you', [
            "order" => $order,
            "from_to" => $from_to
        ]);
    }
}
