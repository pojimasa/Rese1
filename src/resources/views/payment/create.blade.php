@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/payment/create.css') }}">
@endsection

@section('content')
    <div class="payment-container">
        @if(session('flash_alert'))
            <p class="flash-alert">{{ session('flash_alert') }}</p>
        @endif
        @if(session('status'))
            <p class="status">{{ session('status') }}</p>
        @endif

        <form id="payment-form" action="{{ route('payment.store') }}" method="POST">
            @csrf
            <div class="payment-form-header">
                <h4>支払い情報</h4>
            </div>
            <div class="form-group">
                <label for="card-number">カード番号</label>
                <div id="card-number" class="form-control"></div>
            </div>

            <div class="form-group">
                <label for="card-expiry">有効期限</label>
                <div id="card-expiry" class="form-control"></div>
            </div>

            <div class="form-group">
                <label for="card-cvc">セキュリティコード</label>
                <div id="card-cvc" class="form-control"></div>
            </div>

            <div id="card-errors" class="text-danger"></div>

            <button type="submit" class="submit-btn">Submit Payment</button>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stripe = Stripe('{{ config('stripe.key') }}'); // 正しい公開鍵を指定
            const elements = stripe.elements();

            const cardNumber = elements.create('cardNumber');
            cardNumber.mount('#card-number');
            cardNumber.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            const cardExpiry = elements.create('cardExpiry');
            cardExpiry.mount('#card-expiry');
            cardExpiry.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            const cardCvc = elements.create('cardCvc');
            cardCvc.mount('#card-cvc');
            cardCvc.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken('card').then(function(result) {
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                form.submit();
            }
        });
    </script>
@endsection
