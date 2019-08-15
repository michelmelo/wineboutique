@extends('layouts.app')

@section('content')
    <div class="container payment-toggle">
        <checkout-form
            gateway="{{$gateway}}"
            terminal-id="{{$terminalId}}"
            currency="{{$currency}}"
            secret="{{$secret}}"
            test-account="{{$testAccount}}"
            order-id="{{$orderId}}"
            amount="{{$amount}}"
            date-time="{{$requestDateTime}}"
            auth-hash="{{$authHash}}"
            request-url="{{$requestURL}}"
            validation-url="{{$validationURL}}"
            receipturl="{{$receiptPageURL}}"
        ></checkout-form>
    </div>

    <div class="container payment-toggle" style="display: none">
        <div class="row">
            <div class="col-md-12">
                <iframe name="hidden_iframe" style="display: block; width: 100%; height: 600px;"></iframe>
            </div>
        </div>
    </div>
@endsection