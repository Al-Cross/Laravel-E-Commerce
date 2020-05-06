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
                                <div class="img-wrap padding-y">
                                	<img src="{{ asset('storage/' . $product->mainImage()) }}"
                                		style="height: 200px;"
                                		alt="mainImage">
                                </div>

	                            <figcaption class="info-wrap">
	                                <h4 class="title"><a href="{{ $product->path() }}">{{ $product->name }}</a></h4>
	                            </figcaption>
	                            <div class="bottom-wrap">
	                            	<form action="{{ route('add-to-cart') }}" method="POST">
	                            		@csrf
	                            		<input type="hidden" name="id" value="{{ $product->id }}">
	                            		<input type="hidden" name="quantity" value="1">
	                            		<input type="hidden" name="price" value="{{ $product->price }}">
	                            		<button type="submit" class="btn btn-sm btn-success float-right">
	                                	<i class="fa fa-cart-arrow-down"></i> Buy Now
	                                </button>
	                            	</form>
	                                <div class="price h3 text-danger">
	                                	<span class="currency">{{ config('e-commerce.currency_symbol') }}</span>
		                                <span>{{ $product->price }}</span>
	                                </div>
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
	        </div>
	    </div>
	</section>
@endsection
