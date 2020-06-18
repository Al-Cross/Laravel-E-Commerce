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
                                            <a href="{{ route('checkout.cart.remove', $item->id) }}" class="btn btn-outline-danger ml-2">
                                                Remove  <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if(Auth::check())
                        <wishlist :user="{{ Auth::user()->id }}"></wishlist>
                        @include('partials._buy_again')
                    @endif
                </main>
                @if(! \Cart::isEmpty())
                    @include('partials._cart_controls')
                @endif
            </div>
        </div>
        @include('partials._errors')
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
