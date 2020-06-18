@extends ('admin.app')

@section ('title', 'Categories')

@section ('content')
	<div class="container">
		<p>
		 	<a class="btn btn-sm btn-default border" href="{{ route('admin.categories.create') }}">New Category
		 		<i class="fas fa-plus"></i>
		 	</a>
		</p>
		<categories :data="{{ $categories }}"></categories>
	</div>
@endsection
