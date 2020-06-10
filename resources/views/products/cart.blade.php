@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
    <section class="section-content bg padding-y border-top">
        <div class="container">
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
                                                @foreach($item->attributes as $value)
                                                    <div class="aside"><img src="{{'storage/' . $value }}" class="img-sm"></div>
                                                @endforeach
                                                <figcaption class="media-body">
                                                    <h6 class="title text-truncate">{{ Str::words($item->name, 20) }}</h6>
                                                </figcaption>
                                            </figure>
                                        </td>
                                        <td class="block">
                                            <span class="font-weight-bold">{{ $item->quantity }}</span>
                                            <div>
                                               <label for="select">Select:</label>
                                                <select class="form-control" data-name="{{ $item->id }}">
                                                    @for ($i = 1; $i <= ($item->conditions < 10 ? $item->conditions : 10); $i++)
                                                    <option {{ $item->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="price-wrap">
                                                <var class="price">
                                                    {{ config('e-commerce.currency_symbol'). number_format($item->price, 2) }}
                                                </var>
                                                <small class="text-muted">each</small>
                                            </div>
                                            <div class="price-wrap">
                                                <var class="price">
                                                    {{
                                                        config('e-commerce.currency_symbol') .
                                                        number_format(($item->quantity * $item->price), 2)
                                                    }}
                                                </var>
                                                <small class="text-muted">total</small>
                                            </div>
                                        </td>
                                        <td class="text-right d-flex">
                                            @if (Auth::check())
                                                <add-to-wishlist :user="{{ Auth::user()->id }}" :product="{{ $item->id }}"></add-to-wishlist>
                                            @endif
                                            <a href="{{ route('checkout.cart.remove', $item->id) }}" class="btn btn-outline-danger ml-2">Remove  <i class="fa fa-times"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if(Auth::check())
                        <wishlist :user="{{ Auth::user()->id }}"></wishlist>
                    @endif
                </main>
                @if(! \Cart::isEmpty())
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
                @endif
            </div>
            @if(Auth::check())
                <hr>
                <span class="font-weight-bold">Buy Again</span>
                <div class="row">
                    @foreach($purchased as $order)
                        @foreach($order->products as $product)
                            <div class="col-md-3">
                                <figure class="card card-product-grid">
                                    <div class="img-wrap padding-y">
                                        @if($product->featured)
                                            <span class="badge badge-warning ml-5"> FEATURED </span>
                                        @endif
                                        @if($product->new())
                                            <span class="badge badge-danger"> NEW </span>
                                        @endif
                                        <img src="{{ asset('storage/' . $product->mainImage()) }}"
                                            style="height: 200px;"
                                            alt="mainImage">
                                    </div>

                                    <figcaption class="info-wrap bop">
                                        <a class="title" href="{{ $product->path() }}">{{ $product->name }}</a>
                                    </figcaption>
                                    <div class="bottom-wrap">
                                        @if ($product->inStock)
                                            <form action="{{ route('add-to-cart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="price" value="{{ $product->price }}">
                                                <button type="submit" class="btn btn-sm btn-success float-right">
                                                    <i class="fa fa-cart-arrow-down"></i> Buy Now
                                                </button>
                                            </form>
                                        @endif
                                        @if ($product->sale_price != 0)
                                            <div class="price-wrap h5">
                                                <span class="price h3"> {{ config('e-commerce.currency_symbol').$product->sale_price }} </span>
                                                <del class="price-old text-danger"> {{ config('e-commerce.currency_symbol').$product->price }}</del>
                                            </div>
                                        @else
                                            <div class="price-wrap h5">
                                                <span class="price h3"> {{ config('e-commerce.currency_symbol').$product->price }} </span>
                                            </div>
                                        @endif
                                    </div>
                                </figure>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            @endif
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
        // Update product quantity dynamically
        const classname = document.querySelectorAll('.form-control');

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
