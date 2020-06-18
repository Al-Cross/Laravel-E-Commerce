@extends ('admin.app')

@section ('title', 'All Orders')

@section ('content')
	<div class="container clearfix">
        <h2 class="title-page">All Closed Orders:</h2>
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
							    	<th scope="col">Customer</th>
							        <th scope="col">Product</th>
							        <th scope="col">Quantity</th>
							        <th scope="col">Total</th>
							        <th scope="col">Payment Method</th>
							        <th scope="col">Order Date</th>
							    </tr>
							  </thead>
							  <tbody>
					        	@foreach ($orders as $order)
								    <tr>
								    	<td>{{ $order->id }}</td>
								        <th scope="row">
								      	  {{ $order->billing_name }}
								        </th>
								        @foreach($order->products as $product)
										    <td>{{ $product->name }}</td>
										    <td>{{ $product->pivot->quantity }}</td>
									    @endforeach
								        <td>{{ config('e-commerce.currency_symbol') }}{{ number_format($order->billing_total, 2) }}</td>
								        <td>{{ $order->payment_gateway }}</td>
								        <td>
								        	{{ $order->created_at->format('d. M Y') }}
								        </td>
								    </tr>
					        	@endforeach
							  </tbody>
							</table>
			        		<hr>
							{{ $orders->links() }}
		        		</div>
		        		<h4 class="font-weight-bold mr-5">Total Gross Income:</h4>
		        		<h4 class="font-weight-bold text-lg">
			        		{{ config('e-commerce.currency_symbol') }}{{ number_format($income, 2) }}
			        	</h4>
			        </div>
				</div>
            </div>
        </div>
    </section>
@endsection
