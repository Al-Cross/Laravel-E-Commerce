@extends ('layouts.app')

@section ('title', $product->name)

@section('content')
    <section class="section-content bg padding-y border-top" id="site">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
				    <div class="card">
				        <div class="row no-gutters">
				        	<aside class="col-sm-6 border-right">
							    <article class="gallery-wrap">
						            <div class="img-wrap">
						                <div class="padding-y" id="slideshow">
					                        <img src="{{ asset('storage/'. $product->mainImage()) }}" alt="mainImage">
						                </div>
						            </div>
							    </article>
							    @include('partials._slider')
							</aside>

							@include('partials._product_details')
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

@section ('scripts')
	<!-- desoSlide core -->
	<script src="{{ asset('desoslide/js/jquery.desoslide.min.js') }}"></script>
	<script src="{{ asset('frontend/plugins/slickslider/slick.min.js') }}"></script>
	<script>
		$(window).on('load', function() {

			// If the <li> doesn't exist, don't show desoSlide
			if ($('.image').length != 0) {
				$('#slideshow').desoSlide({
			    	thumbs: $('#slideshow_thumbs li > a'),
			        overlay: 'none',
				    controls: {
				        show: false,
				        keys: true
				    }
			    });
			}
		});
	</script>
@endsection
