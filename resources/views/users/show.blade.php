@extends ('layouts.app')

@section ('title', 'My Account')

@section ('content')
	<section class="section-content padding-y">
	<div class="container">

	<div class="row">
		<aside class="col-md-3">
			<ul class="list-group">
				<a class="list-group-item active" href="#"> Account overview  </a>
				<a class="list-group-item" href="{{ route('orders.index') }}"> My Orders </a>
				<a class="list-group-item" href="#"> My wishlist </a>
				<a class="list-group-item" href="{{ route('edit.profile', $user->id) }}">Settings </a>
			</ul>
		</aside> <!-- col.// -->
		<main class="col-md-9">

			<article class="card mb-3">
				<div class="card-body">

					<figure class="icontext">
							<div class="icon">
								<img class="rounded-circle img-sm border" src="images/avatars/avatar3.jpg">
							</div>
							<div class="text">
								<strong> {{ $user->name }} </strong> <br>
								{{ $user->email }} <br>
								<a href="{{ route('edit.profile', $user->id) }}">Edit</a>
							</div>
					</figure>
					<hr>
					<p>
						<i class="fa fa-map-marker text-muted"></i> &nbsp; My address:
						 <br>
						{{ $user->address }},
						{{ $user->city }},
						{{ $user->country}}
						<a href="{{ route('edit.profile', $user->id) }}" class="btn-link"> Edit</a>
					</p>



					<article class="card-group">
						<figure class="card bg">
							<div class="p-3">
								 <h5 class="card-title">{{ $user->orders->count() }}</h5>
								<span>Orders</span>
							</div>
						</figure>
						<figure class="card bg">
							<div class="p-3">
								 <h5 class="card-title">5</h5>
								<span>Wishlists</span>
							</div>
						</figure>
					</article>


				</div> <!-- card-body .// -->
			</article> <!-- card.// -->

			<article class="card  mb-3">
				<div class="card-body">
					<h5 class="card-title mb-4">Recent orders </h5>

					<div class="row">
						@foreach($recentOrders as $order)
							<div class="col-md-6">
								<figure class="itemside  mb-3">
									<div class="aside"><img src="images/items/1.jpg" class="border img-sm"></div>
									<figcaption class="info">
										<time class="text-muted"><i class="fa fa-calendar-alt"></i>
											{{ $order->created_at->diffForHumans() }}
										</time>
										@foreach ($order->products as $product)
											<p>{{ $product->name }}</p>
										@endforeach
									</figcaption>
								</figure>
							</div> <!-- col.// -->
						@endforeach
				</div> <!-- row.// -->

				<a href="#" class="btn btn-outline-primary"> See all orders  </a>
				</div> <!-- card-body .// -->
			</article> <!-- card.// -->

		</main> <!-- col.// -->
	</div>

	</div> <!-- container .//  -->
	</section>
@endsection
