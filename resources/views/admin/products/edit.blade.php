@extends ('admin.app')

@section ('title', 'Edit Product Attributes')

@section ('content')

	<section class="section-content bg padding-y">
        <header class="card-header">
            <h4 class="card-title mt-2 text-center">Update a Product</h4>
        </header>
        <delete-image :data="{{ json_encode($product->images) }}"></delete-image>
        <hr>
        <create-product inline-template :categories="{{ $categories }}" :details="{{ $product }}" :values="{{ $product->attributes }}">
            <div class="container">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <article class="card-body">
                            <form method="POST" enctype="multipart/form-data" @click="errors.clear($event.target.name)">
                               <div class="form-group">
                                    <label for="category" class="font-weight-bold">Category</label>
                                    <select class="select-css" name="category_id" @change="getCategories($event)" v-model="key" required>
                                        <option value="" disabled>Pick a Category...</option>
                                        <option v-for="category in categories" :value="category.id" v-text="category.name"></option>
                                        }
                                    </select>
                                    <form-error v-if="errors.get('category_id')" :errors="errors">
                                        @{{ errors.get('category_id') }}
                                    </form-error>
                                    <div v-for="(attribute, index) in attributes">
                                        <label for="attribute" v-text="attribute.name" class="font-weight-bold m-2"></label>
                                        <small>Select one or enter a new property</small>
                                        <div v-for="value in attribute.values">
                                            <input type="checkbox"
                                                    name="select_value"
                                                    :value="value.id"
                                                    :checked="values.value"
                                                    v-model="product.selected"
                                                    :disabled="!product.selected.includes(value.id) && product.selected.length == attributes.length">
                                            <label for="value" class="font-weight-bold">@{{ value.value }}</label>
                                        </div>
                                        <input type="checkbox"
                                                name="select_value"
                                                :value="attribute.id"
                                                v-model="toggleInput"
                                                :disabled="product.selected.length >= attributes.length"> Select New
                                        <div>
                                           <input type="text"
                                                v-if="toggleInput.includes(attribute.id)"
                                                class="form-control"
                                                name="attr_value"
                                                v-model="product.attr_value[index]"
                                            >
                                            <form-error v-if="errors.get('select_value.' + index)" :errors="errors">
                                                @{{ errors.get('select_value.' + index) }}
                                            </form-error>
                                            <form-error v-if="errors.get('select_value')" :errors="errors">
                                                @{{ errors.get('select_value') }}
                                            </form-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Product Name</label>
                                    <input type="name"
                                            class="form-control"
                                            name="name"
                                            id="name"
                                            v-model="product.name"
                                            required
                                    >
                                    <form-error v-if="errors.get('name')" :errors="errors">@{{ errors.get('name') }}</form-error>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="font-weight-bold">Images</label>
                                    <input type="file"
                                            class="form-control"
                                            ref="image"
                                            name="image"
                                            accept="image/*"
                                            multiple
                                            @change="handleImagesUpload()"
                                    >
                                    <form-error v-if="errors.get('image')" :errors="errors">@{{ errors.get('image') }}</form-error>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold mr-3">Make This Product Featured?</label>
                                    <input type="radio"
                                            name="featured"
                                            value="1"
                                            v-model="product.featured"
                                    > Yes
                                    <input type="radio"
                                            class="ml-5"
                                            name="featured"
                                            value="0"
                                            v-model="product.featured"
                                            checked
                                    > No
                                </div>
                                <div class="form-group">
                                    <label for="description" class="font-weight-bold">Product Description</label>
                                    <textarea class="form-control"
                                            name="description"
                                            rows="5"
                                            id="description"
                                            v-model="product.description"
                                            >
                                    </textarea>
                                    <form-error v-if="errors.get('description')" :errors="errors">
                                        @{{ errors.get('description') }}
                                    </form-error>
                                </div>
                                <div class="form-group">
                                    <label for="price" class="font-weight-bold">Price</label>
                                    <input type="price"
                                            class="form-control"
                                            name="price"
                                            id="price"
                                            v-model="product.price"
                                            required
                                    >
                                    <form-error v-if="errors.get('price')" :errors="errors">@{{ errors.get('price') }}</form-error>
                                </div>
                                <div class="form-group">
                                    <label for="price" class="font-weight-bold">Sale Price</label>
                                    <input type="price"
                                            class="form-control"
                                            name="sale_price"
                                            v-model="product.sale_price"
                                    >
                                    <form-error v-if="errors.get('sale_price')" :errors="errors">
                                        @{{ errors.get('sale_price') }}
                                    </form-error>
                                </div>
                                <div class="form-group">
                                    <label for="quantity" class="font-weight-bold">Quantity</label>
                                    <input type="quantity"
                                            class="form-control"
                                            name="quantity"
                                            id="quantity"
                                            v-model="product.quantity"
                                            required
                                    >
                                    <form-error v-if="errors.get('quantity')" :errors="errors">
                                        @{{ errors.get('quantity') }}
                                    </form-error>
                                </div>
                                <div class="form-group">
                                    <button type="button"
                                            class="btn btn-success btn-block"
                                            :disabled="errors.any()"
                                            @click="createProduct()">Submit
                                    </button>
                                </div>
                            </form>
                        </article>
                    </div>
                </div>
            </div>
    </create-product>
    </section>
@endsection
