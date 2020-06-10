@extends ('admin.app')

@section ('title', 'Registered Users')

@section ('content')
	<div class="container clearfix">
        <h2 class="title-page">All Registered Users:</h2>
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
								    	<th scope="col">Name</th>
								        <th scope="col">Email</th>
								        <th scope="col">City</th>
								        <th scope="col">Country</th>
								    </tr>
								  </thead>
								  <tbody>
						        	@foreach ($users as $user)
									    <tr>
									    	<td>{{ $user->id }}</td>
									        <th scope="row">
									      	  {{ $user->name }}
									        </th>
										    <td>
										      {{ $user->email }}
										    </td>
									        <td>{{ $user->city }}</td>
									        <td>{{ $user->country }}</td>
									        <td>
									        	<form action="users/{{ $user->id }}" method="POST">
									        		@csrf
									        		@method('DELETE')
									        		<button type="submit" class="btn btn-danger">Remove</button>
									        	</form>
									        </td>
									    </tr>
						        	@endforeach
								  </tbody>
								</table>
								{{ $users->links() }}
			        		</div>
			        </div>
				</div>
            </div>
        </div>
    </section>
@endsection
