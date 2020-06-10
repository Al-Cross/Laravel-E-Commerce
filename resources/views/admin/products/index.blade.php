@extends ('admin.app')

@section ('title', 'Manage Products')

@section ('content')
	<div class="container">
		 <p>
		 	<a class="btn btn-sm btn-default border" href="{{ route('admin.products.create') }}">New Product
		 		<i class="fas fa-plus"></i>
		 	</a>
		 </p>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Category</th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>In Store Since</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($products as $product)
					<tr>
						<td>{{ $product->category->name }}</td>
						<td>{{ $product->name }}</td>
						<td>{{ $product->price }}</td>
						<td>{{ $product->quantity }}</td>
						<td>{{ $product->created_at->diffForHumans() }}</td>
						<td><a href="{{ route('admin.product.edit', $product->slug) }}" class="btn btn-warning">Edit</a></td>
						<td>
							<form action="{{ route('admin.product.delete', $product->id) }}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Delete</button>
							</form>
						</td>
					</tr>
				@empty
					<tr>
						<p>No products yet.</p>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
@endsection
