@extends ('layouts.app')

@section ('title', 'Search Results')

@section('content')
    <div class="container clearfix">
        <h2 class="title-page">Your search has returned the following results:</h2>
    </div>
    <section class="section-content bg padding-y border-top" id="site">
        <div class="container">
            <div class="row">
            	<div class="col-md-12">
		        	<p>{{ $products->count() }} Result(s) for '{{ request()->input('query') }}'</p>
            	</div>
                <div class="col-md-12">
			        <div class="row no-gutters">
			        		<div class="col-md-12">
			        			<table class="table table-striped">
								  <thead>
								    <tr>
								      <th scope="col">Name</th>
								      <th scope="col">Details</th>
								      <th scope="col">Description</th>
								      <th scope="col">Price</th>
								    </tr>
								  </thead>
								  <tbody>
						        	@foreach ($products as $product)
									    <tr>
									      <th scope="row">
									      	<a href="{{ $product->path() }}">
									      		{{ $product->name }}
									      	</a>
									      </th>
										    <td>
										      @foreach ($product->attributes as $value)
										    	{{ $value->value }},
											  @endforeach
										    </td>
									      <td class="w-75">{{ Str::limit($product->description, 80) }}</td>
									      <td>{{ config('e-commerce.currency_symbol') }} {{ $product->price }}</td>
									    </tr>
						        	@endforeach
								  </tbody>
								</table>
								{{ $products->links() }}
			        		</div>
			        </div>
				</div>
            </div>
            @include('partials._errors')
        </div>
    </section>
@endsection
