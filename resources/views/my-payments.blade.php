@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row padding-row">

        @include('layouts.partials._profile_menu')

        <div class="col-md-8 col-sm-12">
            <form action="my-payments" method="post" id="payment-form">
                @csrf
                <div class="form-row">
                    <label for="card-element">
                        Credit or debit card
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>
                <br>
                <div class="form-row">
                    <input type="text" name="alias" class="StripeElement" placeholder="Card alias" required>
                </div>
                <br>
                <div class="form-row">
                    <button id="sbmt-new-payment-mtd" class="sbmt-new-payment-mtd button red-button">Submit New Payment Method</button>
                </div>
            </form>
            <br>
            <br>
            <table style="width: 100%" class="stripe-table">
                <tr>
                    <th>Card #</th>
                    <th>Card Alias</th>
                    <th>Is Default</th>
                </tr>
                @foreach($user->payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $payment->alias }}</td>
                        @if($payment->is_default)
                            <td>Yes</td>
                        @else
                            <td>No <a class="float-right button red-button button-small" href="/my-payments/default/{{ $payment->id }}">Make default</a></td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@section('script')
<script>
    var stripe = Stripe('pk_test_bWZc4BcEaCNAKbJbhv6u91ZJ00zZEQ2RIQ');
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    var wasSubmitted = false;

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        if(!wasSubmitted) {
            wasSubmitted = true;
            document.getElementById('sbmt-new-payment-mtd').disabled = true;

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        }
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Ins  ert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>
@endsection
@endsection