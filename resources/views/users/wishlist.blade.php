@extends ('layouts.app')

@section ('title', 'Products')

@section ('content')
	<section class="section-content bg padding-y">
	    <div class="container">
	        <div id="code_prod_complex">
	        	<h1>My Wishlist</h1>
	        	<hr>
	            <div class="row">
	                @forelse($wishlist as $item)
	                    <div class="col-md-3">
	                        <figure class="card card-product-grid mb-4">
                                <div class="img-wrap padding-y">
                                	<img src="{{ asset('storage/' . $item->product->mainImage()) }}"
                                		style="height: 200px;"
                                		alt="mainImage">
                                </div>

	                            <figcaption class="info-wrap border-top">
	                                <h4 class="title"><a href="{{ $item->product->path() }}">{{ $item->product->name }}</a></h4>
	                            </figcaption>
	                            <div class="bottom-wrap">
	                            	<form action="{{ route('add-to-cart') }}" method="POST">
	                            		@csrf
	                            		<input type="hidden" name="id" value="{{ $item->product->id }}">
	                            		<input type="hidden" name="quantity" value="1">
	                            		<input type="hidden" name="price" value="{{ $item->product->price }}">
	                            		<button type="submit" class="btn btn-success float-right">
	                                	<i class="fa fa-cart-arrow-down"></i> Buy Now
	                                </button>
	                            	</form>
	                            	<a href="{{ route('wishlist.remove', [auth()->user()->id, $item->product->id]) }}"
	                            		class="btn btn-outline-danger"><i class="fa fa-times"></i> Remove
	                            	</a>
	                                <div class="price h3 text-danger">
	                                	<span class="currency">{{ config('e-commerce.currency_symbol') }}</span>
		                                <span>{{ $item->product->price }}</span>
	                                </div>
	                            </div>
	                        </figure>
	                    </div>
	                @empty
	                    <span>No Products added yet.</span>
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
