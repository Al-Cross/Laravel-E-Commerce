@extends ('admin.app')

@section ('title', 'Categories')

@section ('content')
	<div class="container">
		 <p>
		 	<a class="btn btn-sm btn-default border" href="{{ route('admin.categories.create') }}">New Category
		 		<i class="fas fa-plus"></i>
		 	</a>
		 </p>
		<table class="table">
			<thead>
				<tr>
					<th>Category</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($categories as $category)
					<tr>
						<td>{{ $category->name }}</td>
						<td><button type="submit" class="btn btn-danger">Delete</button></td>
					</tr>
				@empty
					<tr>
						<p>No categories yet.</p>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
@endsection
