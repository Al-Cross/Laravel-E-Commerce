@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
    <section class="section-content bg padding-y border-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    @if (Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                </div>
                <div class="col-sm-9">
                    @if (Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <main class="col-sm-9">
                    @if (\Cart::isEmpty())
                        <p class="alert alert-warning">Your shopping cart is empty.</p>
                    @else
                        <div class="card">
                            <span class="text-lg font-weight-bold p-2">{{ $cartContents->count() }} item(s) in the shopping cart</span>
                            <table class="table table-hover shopping-cart-wrap">
                                <thead class="text-muted">
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col" width="120">Quantity</th>
                                    <th scope="col" width="120">Price</th>
                                    <th scope="col" class="text-right" width="200">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cartContents as $item)
                                    <tr>
                                        <td>
                                            <figure class="media">
                                                <figcaption class="media-body">
                                                    <h6 class="title text-truncate">{{ Str::words($item->name, 20) }}</h6>
                                                    @foreach($item->attributes as $key  => $value)
                                                        <dl class="dlist-inline small">
                                                            <dt>{{ ucwords($key) }}: </dt>
                                                            <dd>{{ ucwords($value) }}</dd>
                                                        </dl>
                                                    @endforeach
                                                </figcaption>
                                            </figure>
                                        </td>
                                        <td class="block">
                                            <span class="font-weight-bold">{{ $item->quantity }}</span>
                                            <div>
                                               <label for="select">Select:</label>
                                                <select class="quantity" data-name="{{ $item->id }}">
                                                    @for ($i = 0; $i <= 10; $i++)
                                                    <option {{ $item->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="price-wrap">
                                                <var class="price">{{ config('e-commerce.currency_symbol'). $item->price }}</var>
                                                <small class="text-muted">each</small>
                                            </div>
                                            <div class="price-wrap">
                                                <var class="price">{{ config('e-commerce.currency_symbol'). ($item->quantity * $item->price) }}</var>
                                                <small class="text-muted">total</small>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('checkout.cart.remove', $item->id) }}" class="btn btn-outline-danger"><i class="fa fa-times"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </main>
                <aside class="col-sm-3">
                    <a href="{{ route('checkout.cart.clear') }}" class="btn btn-danger btn-block mb-4">Clear Cart</a>
                   {{--  <p class="alert alert-success">Add USD 5.00 of eligible items to your order to qualify for FREE Shipping. </p> --}}
                    <dl class="dlist-align h4">
                        <dt>Total:</dt>
                        <dd class="text-right"><strong>{{ config('e-commerce.currency_symbol') }}{{ \Cart::getSubTotal() }}</strong></dd>
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
            </div>
        </div>
         <div class="container">
                @if ($errors->count() > 0)
                    <ul>
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                <li>{{ $error }}</li>
                            </div>
                        @endforeach
                    </ul>
                @endif
            </div>
    </section>
@stop

@section ('scripts')
    <script>
        const classname = document.querySelectorAll('.quantity');

        Array.from(classname).forEach(function(element) {
            element.addEventListener('change', function() {
                const name = element.getAttribute('data-name');

                axios.patch(`/cart/${name}/update`, { quantity: this.value})
                    .then(function(response) {
                        window.location.href = '{{ route('cart') }}';
                    })
                    .catch(function(error) {
                        window.location.href = '{{ route('cart') }}';
                    });
            });
        });
    </script>
@endsection
