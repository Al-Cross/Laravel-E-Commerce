@extends ('admin.app')

@section ('title', 'Create Category')

@section ('content')

	<section class="section-content bg padding-y">
        <div class="container">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Create a Category</h4>
                    </header>
                    <article class="card-body">
                        <form action="/admin/categories" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="attribute">Attribute</label>
                                <input type="text" class="form-control @error('attribute') is-invalid @enderror" name="attribute[]">
                                @error('attribute.0')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <add-category class="mb-4"></add-category>
                            <div class="form-group">
                            	<button type="submit" class="btn btn-success btn-block">Submit</button>
                            </div>
                        </form>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
