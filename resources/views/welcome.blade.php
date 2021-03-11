<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Bootstrap-ecommerce by Vosidiy M.">

	<title>Bootstrap E-Commerce</title>

	<!-- jQuery -->
	<script src="{{ asset('frontend/js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>

	<!-- Bootstrap4 files-->
	<script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
	<link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />

	<!-- Font awesome 5 -->
	<link href="{{ asset('frontend/fonts/fontawesome/css/all.min.css') }}" type="text/css" rel="stylesheet">

	<!-- custom style -->
	<link href="{{ asset('frontend/css/ui.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet" media="only screen and (max-width: 1200px)" />

	<!-- custom javascript -->
	<script src="{{ asset('frontend/js/script.js') }}" type="text/javascript"></script>
</head>
<body>
    <header class="section-header">
	<section class="header-main border-bottom">
	<div class="container">
		<a href="#" class="brand-wrap"><img class="logo" src="{{ asset('frontend/images/logo.png') }}"></a>

		<div class="d-flex align-items-end flex-column">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    	<div class="d-flex">
                    		<a class="dropdown-item" href="{{ url('/products') }}">Home</a>
	                        <a class="dropdown-item" href="{{ route('logout') }}"
	                           onclick="event.preventDefault();
	                                     document.getElementById('logout-form').submit();">
	                            {{ __('Logout') }}
	                        </a>
	                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                            @csrf
	                        </form>
                    	</div>
                    @else
                    	<div class="d-flex">
                    		<a class="dropdown-item" href="{{ route('login') }}">Login</a>
	                        @if (Route::has('register'))
	                            <a class="dropdown-item" href="{{ route('register') }}">Register</a>
	                        @endif
                    	</div>
                    @endauth
                </div>
            @endif
        </div>
	</div> <!-- container.// -->
	</section>

	<section class="section-pagetop bg-primary">
		<div class="container">
			<h2 class="title-page text-white text-center">Products That Inspire</h2>
		</div>
	</section>
	</header>

	<section class="section-content padding-y bg">
		<div class="container">
			<div class="row">
				<div class="col-md-4 mb-4">
					<div class="card bg-dark">
					  <img src="{{ asset('/frontend/images/banners/computers.jpg') }}" class="card-img opacity" style="height:227px;">
					  <div class="card-img-overlay text-white">
					    <h5 class="card-title">Computers</h5>
					    <p class="card-text">The newest of the world of electronics</p>
					    <a href="/categories/computers" class="btn btn-light">Discover</a>
					  </div>
					</div>
				</div> <!-- col.// -->
				<div class="col-md-4 mb-4">
					<div class="card bg-dark">
					  <img src="{{ asset('/frontend/images/banners/banner2.jpg') }}" class="card-img opacity">
					  <div class="card-img-overlay text-white">
					    <h5 class="card-title">Headphones</h5>
					    <p class="card-text">High-Quality Made Available</p>
					    <a href="/categories/headphones" class="btn btn-light">Discover</a>
					  </div>
					</div>
				</div> <!-- col.// -->
				<div class="col-md-4 mb-4">
					<div class="card-banner align-items-end" style="height:227px; background-image: url('frontend/images/banners/camera-background.jpg');">
						<article class="card-img-overlay text-white">
					    	<h5 class="card-title">Camera & Photo</h5>
					    	<p class="card-text">Save the most memorable moments</p>
					    	<a href="/categories/action-cameras" class="btn btn-light">Discover</a>
					    </article>
					</div>
				</div> <!-- col.// -->
			</div> <!-- row.// -->
			<div class="row">
				<div class="col-md-4">
					<div class="shadow-sm card-banner">
					  <div class="p-4" style="width:75%">
					    <h5 class="card-title">iPad Pro</h5>
					    <p>We work directly with licensed suppliers to deliver the best products.</p>
					  </div>
					  <img src="{{ asset('/frontend/images/banners/banner-item1.jpg') }}" height="150" class="img-bg">
					</div>
				</div>
				<div class="col-md-4">
					<div class="shadow-sm card-banner">
					  <div class="p-4" style="width:70%">
					    <h5 class="card-title">Smart Watch</h5>
					    <p>On our platform you can discover the trendiest fitness gear.</p>
					  </div>
					  <img src="{{ asset('/frontend/images/banners/banner-item2.jpg') }}" height="150" class="img-bg">
					</div>
				</div>
				<div class="col-md-4">
					<div class="shadow-sm card-banner">
					  <div class="p-4" style="width:75%">
					    <h5 class="card-title">Great drones</h5>
					    <p>All displayed products have a minimum 30-day money-back guarantee.</p>

					  </div>
					  <img src="{{ asset('/frontend/images/banners/banner-item3.jpg') }}" height="150" class="img-bg">
					</div>
				</div> <!-- col.// -->
			</div> <!-- row.// -->
		</div>
	</section>
</body>
</html>
