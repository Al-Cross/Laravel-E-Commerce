<?php

namespace App\Http\Controllers\Admin;

use App\Images;
use App\Product;
use App\Category;
use App\Attribute;
use App\AttributeValues;
use App\ProductAttributes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;

class ProductUploadController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }
    /**
     * Display a page for creating a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $attributes = Attribute::with('values')->get();

        return view('admin.products.create', compact('categories', 'attributes'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return \Illuminate\Http\Response
    */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        $product = Product::create([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'description' => $data['description'],
            'price' => $data['price'],
            'quantity' => $data['quantity']
        ]);

        $filtered = array_filter($data['attr_value']);

        if (! empty($filtered)) {
            foreach ($filtered as $attribute => $value) {
                $attr_value = AttributeValues::firstOrCreate(
                    ['value' => $value],
                    ['attribute_id' => $attribute]
                );

                $product->attributes()->attach($attr_value->id);
            }
        }

        $select = array_filter($data['select_value'], function ($string) {
            return strpos($string, 'new') === false;
        });

        foreach ($select as $value_id) {
            $product->attributes()->attach($value_id);
        }

        $images = request()->file('image');
        $paths = [];

        foreach ($images as $image) {
            $imageName = $image->hashName();
            $paths[] = $image->storeAs('images', $imageName);
        }

        foreach ($paths as $path) {
            Images::create([
                'product_id' => $product->id,
                'path' => $path
            ]);
        }

        return redirect('/products');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $attributes = Attribute::with('values')->get();

        return view(
            'admin.products.edit',
            compact('product', 'categories', 'attributes')
        );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param App\Product  $product
    *
    * @return \Illuminate\Http\Response
    */
    public function update(Product $product, StoreProductRequest $request)
    {
        $data = $request->validated();

        $product->update([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'description' => $data['description'],
            'price' => $data['price'],
            'quantity' => $data['quantity']
        ]);

        $filtered = array_filter($data['attr_value']);
        $product->attributes()->detach();
        if (! empty($filtered)) {
            foreach ($filtered as $attribute => $value) {
                $attr_value = AttributeValues::where('attribute_id', '=', $attribute)
                    ->update(['value' => $value]);

                $product->attributes()->attach($attr_value->id);
            }
        }

        $select = array_filter($data['select_value'], function ($string) {
            return strpos($string, 'new') === false;
        });

        foreach ($select as $value_id) {
            $product->attributes()->attach($value_id);
        }

        $images = request()->file('image');
        $paths = [];

        if (! empty($images)) {
            foreach ($images as $image) {
                $imageName = $image->hashName();
                $paths[] = $image->storeAs('images', $imageName);
            }

            foreach ($paths as $path) {
                Images::create([
                    'product_id' => $product->id,
                    'path' => $path
                ]);
            }
        }

        return redirect($product->path());
    }

    /**
     * Delete the selected image.
     * @param  App\Product $product
     * @param  integer  $imageId
     */
    public function removeImage(Product $product, $imageId)
    {
        $imagePath = $product->images->find($imageId);
        $image = basename($imagePath->path);

        Storage::disk('public')->delete('/images/' . $image);
        $imagePath->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $images = $product->images;

        foreach ($images as $image) {
            $imagePath[] = basename($image->path);
        }

        foreach ($imagePath as $path) {
            Storage::disk('public')->delete('/images/' . $path);
        }

        $product->delete();

        return redirect()
            ->back()
            ->with('message', 'Product successfully removed.');
    }
}
