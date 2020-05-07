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
                <div class="col-md-12">
				    <div class="card">
				        <div class="row no-gutters">
				        	<aside class="col-sm-5 border-right">
							    <article class="gallery-wrap">
						            <div class="img-big-wrap">
						                <div class="padding-y">
						                    <a href="{{ asset('storage/'. $product->mainImage()) }}" data-fancybox="">
						                        <img src="{{ asset('storage/'. $product->mainImage()) }}" alt="">
						                    </a>
						                </div>
						            </div>
						            <div class="img-small-wrap">
						                @foreach($product->images as $image)
						                    <div class="item-gallery">
						                        <img src="{{ asset('storage/'. $image->path) }}" style="height: 300px; width: 300px;" alt="{{ $product->name}}">
						                    </div>
						                @endforeach
						            </div>
							    </article>
							</aside>

							<aside class="col-sm-7">
							    <article class="p-5">
							        <h3 class="title mb-3">
							        	{{ $product->name }}
							        	<label
		                        			class="btn {{ $product->inStock ? 'btn-success' : 'btn-danger'}}">
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
							        <form action="{{ route('add-to-cart') }}" method="POST" role="form" id="addToCart">
							            @csrf
							            <div class="row">
							                <div class="col-sm-12">
							                    <dl class="dlist-inline">
							                    	{{ $product->description }}
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
								            <hr>
								            <div class="row">
								                <div class="col-sm-12">
								                    <dl class="dlist-inline">
								                        <dt>Quantity: </dt>
								                        <dd>
								                            <input class="form-control"
								                            		type="number"
								                            		min="1"
								                            		value="1"
								                            		max="{{ $product->quantity }}"
								                            		name="quantity"
								                            		style="width:70px;"
								                            >
								                            <input type="hidden" name="id" value="{{ $product->id }}">
								                            <input type="hidden"
								                            		name="price"
								                            		id="finalPrice"
								                            		value="{{ $product->price }}"
								                            >
								                        </dd>
								                    </dl>
								                </div>
								            </div>
							            @endif
							            <hr>
							            <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Add To Cart</button>
							        </form>
							        <hr>
							        <a href="/products" class="border">
							        	<button class="btn btn-success">Continue Shopping</button>
							        </a>
							    </article>
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
