<aside class="col-sm-3">
    <a href="{{ route('checkout.cart.clear') }}" class="btn btn-danger btn-block mb-4">Clear Cart</a>
    <dl class="dlist-align h4">
        <dt>Total Price:</dt>
        <dd class="text-right">
            <strong>{{ config('e-commerce.currency_symbol') }}{{ number_format(\Cart::getSubTotal(), 2) }}</strong>
        </dd>
    </dl>
    <hr>
    <div class="d-flex">
       <figure class="itemside mb-3">
            <aside class="aside"><img src="{{ asset('frontend/images/icons/pay-visa.png') }}"></aside>
        </figure>
        <figure class="itemside mb-3">
            <aside class="aside"> <img src="{{ asset('frontend/images/icons/pay-mastercard.png') }}"> </aside>
        </figure>
        <figure class="itemside mb-3">
            <aside class="aside"> <img src="{{ asset('storage/svg/PayPal.svg') }}"> </aside>
        </figure>
    </div>
    <a href="{{ route('checkout') }}" class="btn btn-success btn-lg btn-block">Proceed To Checkout</a>
</aside>
