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
						<a class="list-group-item" href="{{ route('wishlist', $user) }}"> My wishlist </a>
						<a class="list-group-item" href="{{ route('edit.profile', $user->id) }}">Settings </a>
					</ul>
				</aside>
				<main class="col-md-9">
					<article class="card mb-3">
						<div class="card-body">
							<figure class="icontext">
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
								<a href="{{ route('edit.profile', $user->id) }}" class="btn-link">Edit</a>
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
										<h5 class="card-title">{{ $user->wishlist->count() }}</h5>
										<span>Items In Wishlist</span>
									</div>
								</figure>
							</article>
						</div>
					</article>
					@if($recentOrders->count() > 0)
						@include('partials._recent_orders')
					@endif
				</main>
			</div>
		</div> <!-- container .//  -->
	</section>
@endsection
