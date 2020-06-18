@extends ('layouts.app')

@section ('title', 'My Orders')

@section ('content')
    <section class="section-content padding-y">
        <div class="container">
            <div class="row">
                <aside class="col-md-3">
                    <ul class="list-group">
                        <a class="list-group-item" href="{{ route('profile') }}"> Account overview  </a>
                        <a class="list-group-item active" href="{{ route('orders.index') }}"> My Orders </a>
                        <a class="list-group-item" href="{{ route('wishlist', $user->id) }}"> My wishlist </a>
                        <a class="list-group-item" href="{{ route('edit.profile', $user->id) }}">Settings </a>
                    </ul>
                </aside>

                <section class="section-content bg padding-y w-75">
                    <div class="container">
						<article class="card mb-3">
							<div class="card-body">
								<h5 class="card-title mb-4">All Orders </h5>

								<div class="row">
									@foreach ($orders as $order)
										<div class="col-md-6">
											<div>Order: {{ $order->id }}</div>
											<div>
												<a href="{{ route('order.details', $order->id) }}" class="btn btn-outline-primary">
													See details
												</a>
											</div>
											<div>Total:
												<span class="currency">{{ config('e-commerce.currency_symbol') }}</span>
												{{ $order->billing_total }}
												<span class="font-weight-bold">Order Placed: </span>
											</div>
											@foreach ($order->products as $product)
												<div class="col-md-10">
													<figure class="itemside  mb-3">
														<div class="aside"><img src="{{ asset('storage/' . $product->mainImage()) }}" class="border img-sm"></div>
														<figcaption class="info">
															<time class="text-muted mb-4"><i class="fa fa-calendar-alt">
																</i> {{ $order->created_at->format('d. M Y') }}
															</time>
															<p><a href="{{ $product->path() }}">{{ $product->name }}</a></p>
														</figcaption>
													</figure>
												</div>
											@endforeach
										</div>
									@endforeach
								</div>
							</div>
						</article>
					</div>
				</section>
			</div>
		</div>
	</section>
@endsection
