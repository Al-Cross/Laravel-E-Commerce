@extends ('layouts.app')

@section ('title', 'Products')

@section ('content')
	<section class="section-content bg padding-y">
	    <div class="container">
	        <div id="code_prod_complex">
	            <div class="row">
	                @forelse($products as $product)
	                    <div class="col-md-4">
	                        <figure class="card card-product mb-4">
	                            @if ($product->images->count() > 0)
	                                <div class="img-wrap padding-y"><img src="{{ asset('storage/'.$product->images->first()->full) }}" alt=""></div>
	                            @else
	                                <div class="img-wrap padding-y"><img src="https://via.placeholder.com/176" alt=""></div>
	                            @endif
	                            <figcaption class="info-wrap">
	                                <h4 class="title"><a href="{{ $product->path() }}">{{ $product->name }}</a></h4>
	                            </figcaption>
	                            <div class="bottom-wrap">
	                                <a href="" class="btn btn-sm btn-success float-right"><i class="fa fa-cart-arrow-down"></i> Buy Now</a>
	                                <span>{{ $product->price }}</span>
	                                {{-- @if ($product->sale_price != 0)
	                                    <div class="price-wrap h5">
	                                        <span class="price"> {{ config('settings.currency_symbol').$product->sale_price }} </span>
	                                        <del class="price-old"> {{ config('settings.currency_symbol').$product->price }}</del>
	                                    </div>
	                                @else
	                                    <div class="price-wrap h5">
	                                        <span class="price"> {{ config('settings.currency_symbol').$product->price }} </span>
	                                    </div>
	                                @endif --}}
	                            </div>
	                        </figure>
	                    </div>
	                @empty
	                    <p>No Products found yet.</p>
	                @endforelse
	            </div>
	        </div>
	    </div>
	</section>
@endsection
