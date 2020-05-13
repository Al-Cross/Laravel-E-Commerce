@extends ('layouts.app')

@section ('title', $product->name)

@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">{{ $product->name }}</h2>
        </div>
    </section>
    <section class="section-content bg padding-y border-top" id="site">
        <div class="container">
        	<div class="row">
                <div class="col-sm-12">
                    @if (Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @elseif (Session::has('error'))
                        <p class="alert alert-danger mb-4">{{ Session::get('error') }}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
				    <div class="card">
				        <div class="row no-gutters">
				        	<aside class="col-sm-5 border-right">
							    <article class="gallery-wrap">
						            <div class="img-big-wrap">
						                <div class="padding-y">
						                    <a href="{{ asset('storage/'. $product->mainImage()) }}" data-fancybox="">
						                        <img src="{{ asset('storage/'. $product->mainImage()) }}" alt="mainImage">
						                    </a>
						                </div>
						            </div>
				                    <div class="owl-carousel owl-theme">
						                @foreach($product->images as $image)
						                	<a href="{{ asset('storage/'. $image->path) }}" data-fancybox="">
						                        <img src="{{ asset('storage/'. $image->path) }}"
						                        	style="max-height: 150px; max-width: 150px;"
						                        	alt="{{ $product->name}}">
						                	</a>
						                @endforeach
				                    </div>
							    </article>
							</aside>

							<aside class="col-sm-7">
							    <article class="p-5">
							        <h3 class="title mb-3">
							        	{{ $product->name }}
							        	<label
		                        			class="btn {{ $product->inStock ? 'btn-success' : 'btn-danger'}} btn-sm">
		                        			{{ $product->inStock ? 'In' : 'Out of' }} Stock
			                        	</label>
							        </h3>
							        <div class="mb-3">
							                <var class="price h3 text-danger">
							                    <span class="currency">{{ config('e-commerce.currency_symbol') }}</span><span class="num" id="productPrice">{{ $product->price }}</span>
							                    {{-- <del class="price-old"> {{ config('settings.currency_symbol') }}{{ $product->price }}</del> --}}
							                </var>
							        </div>
							        <hr>

							            <div class="row">
							                <div class="col-sm-12">
							                    <dl class="dlist-inline">
							                    	@if ($product->description)
								                    	{{ $product->description }}
							                    		<hr>
							                    	@endif
							                    	@foreach ($product->attributes as $value)
							                    		@foreach ($category->attributes as $attribute)
							                    			<div class="mb-3">
							                    				@if ($value->attribute_id == $attribute->id)
								                    				<span class="font-weight-bold">
								                    					{{ $attribute->name}}:
								                    				</span>
										                    		<span>{{$value->value}}</span>
										                    	@endif
							                    			</div>
							                    		@endforeach
							                    	@endforeach
							                    </dl>
							                </div>
							            </div>
							            @if ($product->inStock)
											@include ('partials._add_to_cart_form')
							            @endif
							        <hr>
							        <div class="d-flex">
								        <add-to-wishlist :user="{{ Auth::user()->id }}" :product="{{ $product->id }}"></add-to-wishlist>
								        <a href="/products" class="border ml-4">
								        	<button class="btn btn-success">Continue Shopping</button>
								        </a>
							        </div>
							    </article>
							    <wishlist :user="{{ Auth::user()->id }}"></wishlist>
							</aside>
				        </div>
				    </div>
				</div>
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
@endsection

@section ('scripts')
<script src="{{ asset('frontend/plugins/owlcarousel/owl.carousel.min.js') }}"></script>

<script>
	$(document).ready(function(){
	  $(".owl-carousel").owlCarousel();
	});
</script>
@endsection
