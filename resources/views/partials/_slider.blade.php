<div class="col-lg-12">
	<ul id="slideshow_thumbs" class="d-flex justify-content-around" style="overflow-x: auto;">
		@foreach($product->images as $image)
			<div class="p-2 row">
            	<li class="p-2 card card-product-grid image mr-2">
                    <a href="{{ asset('storage/'. $image->path) }}">
                        <img src="{{ asset('storage/'. $image->path) }}"
                            class="shadow-lg"
                            style="max-height: 150px; max-width: 150px;"
                            alt="{{ $product->name}}">
                    </a>
                </li>
			</div>
        @endforeach
    </ul>
</div>
