@extends ('layouts.app')

@section ('title', $product->name)

@section('content')
    <section class="section-content bg padding-y border-top" id="site">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
				    <div class="card">
				        <div class="row no-gutters">
				        	<aside class="col-sm-6 border-right">
							    <article class="gallery-wrap">
						            <div class="img-big-wrap">
						                <div class="padding-y">
						                    <a href="{{ asset('storage/'. $product->mainImage()) }}" data-fancybox="">
						                        <img src="{{ asset('storage/'. $product->mainImage()) }}" alt="mainImage">
						                    </a>
						                </div>
						            </div>
							    </article>
							    @include('partials._slider')
							</aside>

							<aside class="col-sm-6">
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
							                	@if($product->sale_price != 0)
								                    <span class="currency">{{ config('e-commerce.currency_symbol') }}</span><span class="num" id="productPrice">{{ $product->sale_price }}</span>
							                    <del class="price-old">
							                    	{{ config('e-commerce.currency_symbol') }}{{ $product->price }}
							                    </del>
							                    @else
							                    <span class="price">
							                    	{{ config('e-commerce.currency_symbol') }}{{ $product->price }}
							                    </span>
							                    @endif
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
							        	@if(Auth::check())
									        <add-to-wishlist :user="{{ Auth::user()->id }}"
						        				:product="{{ $product->id }}">
					        				</add-to-wishlist>
								        @endif
								        <a href="/products" class="ml-4">
								        	<button class="btn btn-success">Continue Shopping</button>
								        </a>
								        @if (Auth::check() && Auth::user()->isAdmin())
									    	<a href="{{ route('admin.product.edit', $product->slug) }}" class="ml-4">
									        	<button class="btn btn-warning">Edit Product</button>
									        </a>
									    @endif
							        </div>
							    </article>
							    @if(Auth::check())
								    <wishlist :user="{{ Auth::user()->id }}"></wishlist>
							    @endif
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
	<script src="{{ asset('frontend/plugins/slickslider/slick.min.js') }}"></script>

	<script>
		$(document).ready(function() {
		   if ($('.slider-custom-slick').length > 0) { // check if element exists
		        $('.slider-custom-slick').slick({
		              infinite: true,
		              slidesToShow: 3,
		              dots: true,
		              prevArrow: $('.slick-prev-custom'),
		              nextArrow: $('.slick-next-custom')
		        });
		    } // end if
		});
	</script>
@endsection
