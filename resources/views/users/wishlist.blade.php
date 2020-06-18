@extends ('layouts.app')

@section ('title', 'Wishlist')

@section ('content')
	<section class="section-content bg padding-y">
	    <div class="container">
	    	<div class="row">
	    		<aside class="col-md-3">
					<ul class="list-group">
						<a class="list-group-item" href="{{ route('profile') }}"> Account overview  </a>
						<a class="list-group-item" href="{{ route('orders.index') }}"> My Orders </a>
						<a class="list-group-item active" href="#"> My wishlist </a>
						<a class="list-group-item" href="{{ route('edit.profile', $user->id) }}">Settings </a>
					</ul>
				</aside>
		        <section class="section-content bg w-75">
		        	<h1>Things To Buy Next</h1>
		        	<hr>
	        		<div class="container">
	                    <div class="row">
			        		@forelse($wishlist as $item)
			        			<div class="col-md-4">
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
		        	</div>
		            @include('partials._errors')
		        </section>
			</div>
	    </div>
	</section>
@endsection
