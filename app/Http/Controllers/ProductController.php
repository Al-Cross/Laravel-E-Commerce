<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\OrderProduct;
use Illuminate\Http\Request;
use App\Filters\ProductFilters;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, ProductFilters $filters)
    {
        if ($category->exists) {
            $products = $category->products()
                ->filter($filters)
                ->latest()
                ->paginate(20);
        } else {
            $products = Product::filter($filters)->latest()->paginate(20);
        }

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, Product $product)
    {
        return view('products.show', compact('category', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * Add a product to the shopping cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function fillCart()
    {
        $product = Product::findOrFail(request()->id);

        $product->addToCart(request('price'), request('quantity'));

        return redirect()
                ->back()
                ->with('flash', 'Item added to cart successfully.');
    }

    /**
     * Find a product.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        request()->validate([
            'query' => ['required', 'min:3']
        ]);

        $query = request()->input('query');

        $products = Product::search($query)->paginate(20);

        return view('products.search_results', compact('products'));
    }
}
