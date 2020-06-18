@extends ('admin.app')

@section ('title', 'Coupons')

@section ('content')
	<p>
	 	<a class="btn btn-sm btn-default border" href="/admin/coupons/new">New Coupon
	 		<i class="fas fa-plus"></i>
	 	</a>
	</p>
	<div class="container clearfix">
        <h2 class="title-page">Registered Coupons:</h2>
    </div>
    <section class="section-content bg padding-y border-top" id="site">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
			        <div class="row no-gutters">
		        		<div class="col-md-12">
		        			<table class="table table-striped">
							  <thead>
							    <tr>
							    	<th>#</th>
							    	<th scope="col">Coupon Code</th>
							        <th scope="col">Type</th>
							        <th scope="col">Value</th>
							        <th scope="col">Percent Off</th>
							        <th scope="col">Delete</th>
							    </tr>
							  </thead>
							  <tbody>
					        	@foreach ($coupons as $coupon)
								    <tr>
								    	<td>{{ $coupon->id }}</td>
								        <td>{{ $coupon->code }}</td>
								        <td>{{ $coupon->type }}</td>
								        <td>{{ $coupon->value }}</td>
								        <td>{{ $coupon->percent_off }}</td>
								        <td>
											<form action="/admin/coupons/remove/{{ $coupon->id }}" method="POST">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger">Delete</button>
											</form>
										</td>
								    </tr>
					        	@endforeach
							  </tbody>
							</table>
		        		</div>
			        </div>
				</div>
            </div>
        </div>
    </section>
@endsection
