@extends('layouts.app')

@section('content')
    <div class="container">
        <checkout-form
            gateway="{{$gateway}}"
            terminal-id="{{$terminalId}}"
            currency="{{$currency}}"
            secret="{{$secret}}"
            test-account="{{$testAccount}}"
            receipt-page-url="{{$receiptPageURL}}"
            order-id="{{$orderId}}"
            amount="{{$amount}}"
            date-time="{{$requestDateTime}}"
            auth-hash="{{$authHash}}"
            request-url="{{$requestURL}}"
            validation-url="{{$validationURL}}"
        ></checkout-form>
    </div>
@endsection