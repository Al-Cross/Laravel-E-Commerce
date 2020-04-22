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

class ProductUploadController extends Controller
{
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

    public function store()
    {
        $data = request()->validate(
            [
            'category_id' => 'required',
            'name' => ['required', 'string'],
            'description' => ['min:10', 'nullable'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'integer'],
            'select_value' => ['required', 'array'],
            'select_value.*' => 'required',
            'attr_value' => ['required_if:select_value.*,1', 'array'],
            'attr_value.*' => ['required_if:select_value.*,1'],
            'image' => ['required', 'array'],
            'image.*' => ['required', 'image', 'mimes:jpeg,jpg,png']
        ],
            ['category_id.required' => 'Please select a category.']
        );

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
                $attr_id = AttributeValues::firstOrCreate(
                    ['value' => $value],
                    ['attribute_id' => $attribute]
                );

                ProductAttributes::create([
                    'product_id' => $product->id,
                    'attr_value_id' => $attr_id->id
                ]);
            }
        }

        $select = array_filter($data['select_value'], function ($string) {
            return strpos($string, 'new') === false;
        });

        foreach ($select as $value_id) {
            ProductAttributes::create([
                'product_id' => $product->id,
                'attr_value_id' => $value_id
            ]);
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
}
