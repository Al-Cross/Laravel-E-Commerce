@extends ('admin.app')

@section ('title', 'Create Category')

@section ('content')

	<section class="section-content bg padding-y">
        <div class="container">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Create a Product</h4>
                    </header>
                    <article class="card-body">
                        <form action="/admin/products" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id">
                                    <option selected disabled>Pick a Category...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        id="name"
                                        value="{{ old('name') }}"
                                        required
                                >
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Images</label>
                                <input type="file"
                                        class="form-control @error('image') is-invalid @enderror"
                                        name="image[]"
                                        id="image"
                                        multiple
                                >
                                @foreach ($errors->get('image') as $message)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="description">Product Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                        name="description"
                                        rows="5"
                                        id="description"
                                        value="{{ old('description') }}">
                                </textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                @foreach ($attributes as $attribute)
                                    <div class="form-group">
                                        <label for="attribute">{{ $attribute->name }}</label>
                                        <select name="select_value[]" id="{{ $attribute->id }}">
                                            @foreach ($attribute->values as $value)
                                                <option value="{{ $value->id }}">{{ $value->value }}</option>
                                            @endforeach
                                            <option value="new {{ $attribute->id }}">
                                                Set New {{ $attribute->name }}
                                            </option>
                                        </select>
                                        <div class="toggle" id="attr_{{ $attribute->name }}">
                                           <input type="text"
                                                class="form-control"
                                                name="attr_value[{{ $attribute->id }}]"
                                            >
                                        </div>
                                        @foreach ($errors->get('attr_value.*') as $array)
                                            @foreach ($array as $message)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @endforeach
                                        @endforeach
                                    </div>
                                @endforeach
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        name="price"
                                        id="price"
                                        value="{{ old('price') }}"
                                        required
                                >
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        name="quantity"
                                        id="quantity"
                                        value="{{ old('quantity') }}"
                                        required
                                >
                                @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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
    <script src="{{ asset('backend/js/jquery-3.3.1.min.js') }}"></script>

 <script>
    $(function() {
        var attributes = {!! json_encode($attributes->toArray(), JSON_HEX_TAG) !!};

        $.each(attributes, function(index, item) {
            if (item.values.length != 0) {
                $('.toggle').hide();
            }

            $('#' + item.id).change(function() {
                reveal();
            });

            function reveal() {
                if ($("#" + item.id + " option:selected").val() == 'new ' + item.id) {
                    $("#attr_" + item.name).show();
                } else {
                    $("#attr_" + item.name).hide();
                }
            }
        });
    });
</script>
