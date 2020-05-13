<form action="{{ route('add-to-cart') }}" method="POST" role="form" id="addToCart">
    @csrf
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
    <hr>
    <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Add To Cart</button>
</form>
