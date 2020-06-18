<article class="card  mb-3">
	<div class="card-body">
		<h5 class="card-title mb-4">Recent orders</h5>
		<div class="row">
			@foreach($recentOrders as $order)
				<div class="col-md-6">
					<figure class="itemside  mb-3">
						@foreach ($order->products as $product)
							<div class="aside">
								<img src="{{ asset('storage/' . $product->mainImage()) }}" class="border img-sm">
							</div>
							<figcaption class="info">
								<time class="text-muted"><i class="fa fa-calendar-alt"></i>
									{{ $order->created_at->format('d. M Y') }}
								</time>
								<p><a href="{{ $product->path() }}">{{ $product->name }}</a></p>
							</figcaption>
						@endforeach
					</figure>
				</div>
			@endforeach
	</div>
	<a href="{{ route('orders.index') }}" class="btn btn-outline-primary">See all orders</a>
	</div>
</article>
