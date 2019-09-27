@extends('layouts.app')

@section('content')
    <div class="container payment-toggle">
        <checkout-form
            gateway="{{$gateway}}"
            terminal-id="{{$terminalId}}"
            currency="{{$currency}}"
            secret="{{$secret}}"
            test-account="{{$testAccount}}"
            has-payment="{{$hasPayment}}"
            amount="{{$amount}}"
            date-time="{{$requestDateTime}}"
            auth-hash="{{$authHash}}"
            request-url="{{$requestURL}}"
            validation-url="{{$validationURL}}"
            receipturl="{{$receiptPageURL}}"
        >
            {{ csrf_field() }}
        </checkout-form>
    </div>
@endsection