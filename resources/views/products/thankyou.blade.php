@extends ('layouts.app')

@section ('title', 'Thank you!')

@section ('content')
	<div class="container">
		<div class="d-flex flex-column" align="center">
			<span class="font-weight-bold text-lg p-3">Thank you for your order!</span>
			<small class="p-3">A confirmation email was sent.</small>
			<span class="border col-md-auto text-center p-3">
				<a href="/products">Home Page</a>
			</span>
		</div>
	</div>
@endsection
