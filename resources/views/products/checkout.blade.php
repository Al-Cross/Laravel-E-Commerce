@extends('layouts.app')

@section('title', 'Shopping Cart')

@section ('extra-css')
<style type="text/css">
    .StripeElement {
      box-sizing: border-box;

      height: 40px;

      padding: 16px 16px;

      border: 1px solid #ccc;
    }

    .StripeElement--focus {
      /*box-shadow: 0 1px 3px 0 #cfd7df;*/
    }

    .StripeElement--invalid {
      border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
      background-color: #fefde5 !important;
    }

    #card-errors {
        color: #fa755a
    }

    &:disabled {
        background: lighten($primary, 10%);
        cursor: not-allowed;
    }
</style>
@endsection

@section('content')
    <section class="section-content bg padding-y border-top">
        <div class="container d-flex justify-content-center">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Billing Details</h4>
                    </header>
                    @include('partials._billing_form')

                </div>
            </div>
            @include('partials._order_details')
        </div>
    </section>
@stop

@section('scripts')
  <script src="https://js.stripe.com/v3/"></script>
  <script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.min.js"></script>

  <script>
      // Create a Stripe client.
      var stripe = Stripe('{{ config('services.stripe.key') }}');

      // Create an instance of Elements.
      var elements = stripe.elements();

      // Custom styling can be passed to options when creating an Element.
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
      var card = elements.create('card', {
          style: style,
          hidePostalCode: true
      });

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
      form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Prevent the double submission of the form
        document.getElementById('complete-order').disabled = true;

        var options = {
          name: document.getElementById('name_on_card').value,
          address_line1: document.getElementById('address').value,
          address_city: document.getElementById('city').value,
          address_country: document.getElementById('country').value,
          address_zip: document.getElementById('postalcode').value
      };

        stripe.createToken(card, options).then(function(result) {
          if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;

            document.getElementById('complete-order').disabled = false;
          } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
          }
        });
      });

      // Submit the form with the token ID.
      function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
      }

      // PayPal
      var form = document.querySelector('#paypal-form');
      var client_token = "{{ $paypalToken }}";
      document.getElementById('button-pay').disabled = true;

      braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',
        paypal: {
          flow: 'vault'
        }
      }, function (createErr, instance) {
        if (createErr) {
          console.log('Create Error', createErr);
          return;
        }

        // Remove the credit card field
        var card = document.querySelector('.braintree-option__card');
        card.parentNode.removeChild(card);

        // Enable the Pay With Paypal button after the user selects the PayPal option
        var paypal = document.querySelector('.braintree-option__paypal');
        paypal.addEventListener('click', function(event) {
            event.preventDefault();

            document.getElementById('button-pay').disabled = false;
        });

        form.addEventListener('submit', function (event) {
          event.preventDefault();

          instance.requestPaymentMethod(function (err, payload) {
            if (err) {
              console.log('Request Payment Method Error', err);
              return;
            }

            // Add the nonce to the form and submit
            document.querySelector('#nonce').value = payload.nonce;
            form.submit();
          });
        });
      });
  </script>
@endsection
