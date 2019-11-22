<?php

namespace App\Http\Controllers;

use App\UserPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        $user = Auth::user();

        return view('my-payments', [
            "user" => $user
        ]);
    }

    public function store(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_PRIVATE_KEY'));

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
            $user_payment->is_default = 1;

            $user_payment->save();

            UserPayment::where("id", "!=", $user_payment->id)->update(["is_default" => 0]);

            return redirect("my-payments")->with('message', 'Success.');
        }

        return redirect("my-payments")->with('message', 'Failed.');
    }

    public function update(UserPayment $payment)
    {
        if($payment->user_id != Auth::user()->id){
            return redirect("/my-payments")->with("error", "Permission denied");
        }

        $payment->is_default = 1;
        $payment->save();

        UserPayment::where("id", "!=", $payment->id)->update(["is_default" => 0]);

        return redirect("/my-payments");
    }
}
