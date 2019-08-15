@extends('layouts.app')

@section('content')
    <div class="container">
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

    <iframe name="hidden_iframe" width="800" height="600"></iframe>
@endsection