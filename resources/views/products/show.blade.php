@extends ('layouts.app')

@section('content')
    {{-- <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">{{ $product->name }}</h2>
        </div>
    </section> --}}
    <section class="section-content bg padding-y border-top" id="site">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
				    <div class="card">
				        <div class="row no-gutters">
				        	<aside class="col-sm-5 border-right">
							    <article class="gallery-wrap">
							        {{-- @if ($product->images->count() > 0)
							            <div class="img-big-wrap">
							                <div class="padding-y">
							                    <a href="{{ asset('storage/'.$product->images->first()->full) }}" data-fancybox="">
							                        <img src="{{ asset('storage/'.$product->images->first()->full) }}" alt="">
							                    </a>
							                </div>
							            </div>
							        @else
							            <div class="img-big-wrap">
							                <div>
							                    <a href="https://via.placeholder.com/176" data-fancybox=""><img src="https://via.placeholder.com/176"></a>
							                </div>
							            </div>
							        @endif
							         @if ($product->images->count() > 0)
							            <div class="img-small-wrap">
							                @foreach($product->images as $image)
							                    <div class="item-gallery">
							                        <img src="{{ asset('storage/'.$image->full) }}" alt="">
							                    </div>
							                @endforeach
							            </div>
							        @endif --}}
							    </article>
							</aside>

							<aside class="col-sm-7">
							    <article class="p-5">
							        <h3 class="title mb-3">{{ $product->name }}</h3>

							        <div class="mb-3">
							            @if ($product->price > 0)
							                <var class="price h3 text-danger">
							                    <span class="currency">{{ config('settings.currency_symbol') }}</span><span class="num" id="productPrice">{{ $product->price }}</span>
							                    <del class="price-old"> {{ config('settings.currency_symbol') }}{{ $product->price }}</del>
							                </var>
							            @else
							                <var class="price h3 text-success">
							                    <span class="currency">{{ config('settings.currency_symbol') }}</span><span class="num" id="productPrice">{{ $product->price }}</span>
							                </var>
							            @endif
							        </div>
							        <hr>
							        <form action="" method="POST" role="form" id="addToCart">
							            @csrf
							            <div class="row">
							                <div class="col-sm-12">
							                    <dl class="dlist-inline">
							                    	{{ $product->description }}
							                        {{-- @foreach($attributes as $attribute)
							                            @php $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray()) @endphp
							                            @if ($attributeCheck)
							                                <dt>{{ $attribute->name }}: </dt>
							                                <dd>
							                                    <select class="form-control form-control-sm option" style="width:180px;" name="{{ strtolower($attribute->name ) }}">
							                                        <option data-price="0" value="0"> Select a {{ $attribute->name }}</option>
							                                        @foreach($product->attributes as $attributeValue)
							                                            @if ($attributeValue->attribute_id == $attribute->id)
							                                                <option
							                                                    data-price="{{ $attributeValue->price }}"
							                                                    value="{{ $attributeValue->value }}"> {{ ucwords($attributeValue->value . ' +'. $attributeValue->price) }}
							                                                </option>
							                                            @endif
							                                        @endforeach
							                                    </select>
							                                </dd>
							                            @endif
							                        @endforeach --}}
							                    </dl>
							                </div>
							            </div>
							            <hr>
							            <div class="row">
							                <div class="col-sm-12">
							                    <dl class="dlist-inline">
							                        <dt>Quantity: </dt>
							                        <dd>
							                            <input class="form-control" type="number" min="1" value="1" max="{{ $product->quantity }}" name="qty" style="width:70px;">
							                            <input type="hidden" name="productId" value="{{ $product->id }}">
							                            <input type="hidden" name="price" id="finalPrice" {{-- value="{{ $product->sale_price != '' ? $product->sale_price : $product->price }}" --}}>
							                        </dd>
							                    </dl>
							                </div>
							            </div>
							            <hr>
							            <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Add To Cart</button>
							        </form>
							    </article>
							</aside>
				        </div>
				    </div>
				</div>
            </div>
        </div>
    </section>
@endsection
