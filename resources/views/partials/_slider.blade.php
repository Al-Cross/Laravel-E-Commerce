<div class="col-md-12">
	<div class="slider-custom-slick row">
		@foreach($product->images as $image)
            @if ($product->mainImage() !== $image->path)
				<div class="item-slide p-2">
                	<figure class="card card-product-grid">
                    	<div class="img-wrap">
                    		<img src="{{ asset('storage/'. $image->path) }}"
                    			class="shadow-lg"
                    			style="max-height: 200px; max-width: 200px;"
                    			alt="{{ $product->name}}">
                    	</div>
                    </figure>
				</div>
            @endif
        @endforeach
    </div>
</div>
