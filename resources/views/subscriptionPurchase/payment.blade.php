@extends('layout.app')
@section('title', __('payment'))
@section('content')
    <style>
        .heading {
            font-size: 23px;
            font-weight: 00
        }

        .text {
            font-size: 16px;
            font-weight: 500;
            color: #b1b6bd
        }

        .pricing {
            border: 2px solid #304FFE;
            background-color: #f2f5ff
        }

        .business {
            font-size: 20px;
            font-weight: 500;
        }

        .plan {
            color: #aba4a4
        }

        .dollar {
            font-size: 16px;
            color: #6b6b6f
        }

        .amount {
            font-size: 50px;
            font-weight: 500
        }

        .year {
            font-size: 20px;
            color: #6b6b6f;
            margin-top: 19px
        }

        .detail {
            font-size: 22px;
            font-weight: 500
        }

        .cvv {
            height: 44px;
            width: 73px;
            border: 2px solid #eee
        }

        .cvv:focus {
            box-shadow: none;
            border: 2px solid #304FFE
        }

        .email-text {
            height: 55px;
            border: 2px solid #eee
        }

        .email-text:focus {
            box-shadow: none;
            border: 2px solid #304FFE
        }

        .payment-button {
            height: 70px;
            font-size: 20px
        }

        #card-element {
            height: 40px;
        }
    </style>
    <section>
        <div class="subscription-container-fluid">
            <div class="card-body">
                <div class="container mt-5 mb-5 d-flex justify-content-center">
                    <div class="card p-5">
                        <div>
                            <h4 class="heading">Upgrade your plan</h4>
                            <p class="text">Please make the payment to start enjoying all the features of our premium
                                plan as soon as possible</p>
                        </div>
                        <div class="pricing p-3 rounded mt-4 d-flex justify-content-between">
                            <div class="images d-flex flex-row align-items-center">
                                <div class="d-flex flex-column ml-4"> <span
                                        class="business">{{ $subscription->title ?? '--' }}</span> <span
                                        class="plan">CHANGE PLAN</span> </div>
                            </div> <!--pricing table-->
                            <div class="d-flex flex-row align-items-center"> <sup
                                    class="dollar font-weight-bold">{{ $general_settings?->defaultCurrency->symbol }}</sup>
                                <span class="amount ml-1 mr-1">{{ $subscription->price ?? '--' }}</span>
                                <span class="year font-weight-bold">/ {{ $subscription->recurring_type ?? '--' }}</span>
                            </div> <!-- /pricing table-->
                        </div> <span class="detail mt-5">Payment method</span>
                        <div class="credit rounded mt-4 d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row align-items-center w-100"> <img src="/icons/stripe.svg"
                                    class="rounded" width="70">
                                <div class="d-flex flex-column w-100"><span class="business"
                                        style="margin: 18px">Stripe</span></div>
                            </div>
                        </div>

                        <form role="form" action="{{ route('payment.process', $subscriptionRequest->id) }}" method="post"
                            id="payment-form">
                            @csrf
                            <input type="hidden" name="stripeToken" id="stripe-token-id">

                            <div id="card-element" class="form-control my-3"></div>
                            <span class="text-danger" id="stripe-error"></span>
                            <div class="mt-3"><button type="button" class="btn common-btn btn-block payment-button w-100" id="pay-btn" onclick="createToken()">Proceed to
                                    payment
                                    <i class="fa fa-long-arrow-right"></i></button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        var stripe = Stripe('{{ config("app.stripe_pk") }}')
        var elements = stripe.elements();

        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        function createToken() {
            document.getElementById("pay-btn").disabled = true;
            stripe.createToken(cardElement).then(function(result) {

                if (typeof result.error != 'undefined') {
                    document.getElementById("pay-btn").disabled = false;
                    $('#stripe-error').text(result.error.message)
                }

                /* creating token success */
                if (typeof result.token != 'undefined') {
                    document.getElementById("stripe-token-id").value = result.token.id;
                    document.getElementById('payment-form').submit();
                }
            });
        }
    </script>
@endpush
