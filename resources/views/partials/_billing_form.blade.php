<article class="card-body">
    <form action="/checkout" method="POST" id="payment-form">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="name"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name"
                    id="name"
                    value="{{ old('name') }}" required>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email')}}" required>
            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text"
                    id="address"
                    class="form-control @error('address') is-invalid @enderror"
                    name="address"
                    value="{{ old('address') }}" required>
            @error('address')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text"
                    id="city"
                    class="form-control @error('city') is-invalid @enderror"
                    name="city"
                    value="{{ old('city') }}" required>
            @error('city')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="postalcode">Postal Code</label>
            <input type="text"
                    id="postalcode"
                    class="form-control @error('postalcode') is-invalid @enderror"
                    name="postalcode"
                    value="{{ old('postalcode') }}" required>
            @error('postalcode')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <input type="text"
                    id="country"
                    class="form-control @error('country') is-invalid @enderror"
                    name="country"
                    value="{{ old('country') }}" required>
            @error('country')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text"
                    class="form-control @error('phone') is-invalid @enderror"
                    name="phone"
                    value="{{ old('phone') }}">
            @error('phone')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name_on_card">Name On Card</label>
            <input type="text"
                    id="name_on_card"
                    class="form-control @error('name_on_card') is-invalid @enderror"
                    name="name_on_card"
                    value="{{ old('name_on_card') }}"
            >
            @error('name_on_card')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <div class="form-row flex-column">
               <label for="card-element">
                  Credit or debit card
                </label>
                <div id="card-element" class="mb-4">
                  <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
                <button type="submit"
                        id="complete-order"
                        class="btn btn-success btn-lg btn-block">Submit Payment</button>
            </div>
        </div>
    </form>

    <div class="mt-3">or</div>
    <div class="mt-3">
        <h4>Pay With PayPal</h4>

        <form method="POST" id="paypal-form" action="{{ route('paypal') }}">
            @csrf
            <section>
                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>

            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="btn btn-primary" id="button-pay" type="submit"><span>Pay with Paypal</span></button>
        </form>
    </div>
</article>
