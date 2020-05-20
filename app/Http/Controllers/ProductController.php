<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $products = Product::all();

        if ($category->exists) {
            $products = $products->where('category_id', $category->id);

            if (request('price') == 'desc') {
                $products = $products->sortByDesc('price');
            } elseif (request('price') == 'asc') {
                $products = $products->sortBy('price');
            }
        }

        if (request('price') == 'desc') {
            $products = $products->sortByDesc('price');
        } elseif (request('price') == 'asc') {
            $products = $products->sortBy('price');
        }

        if (request()->has('demand')) {
            $productIds = DB::table('products')
                ->join('order_product', 'products.id', '=', 'order_product.product_id')
                ->select('product_id', DB::raw('SUM(order_product.quantity) as quantity'))
                ->groupBy('product_id')
                ->orderBy('quantity', 'DESC')
                ->get();

            foreach ($productIds as $id) {
                $product[] = $id->product_id;
            }

            if (isset($product)) {
                $products = Product::findMany($product);
            } else {
                return redirect()
                    ->back()
                    ->with(
                        'message',
                        'No hot items yet. Be the first to take the lead!'
                    );
            }
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
    public function addToCart()
    {
        $product = Product::findOrFail(request()->id);

        $product->addToCart(request('price'), request('quantity'));

        return redirect()
                ->back()
                ->with('message', 'Item added to cart successfully.');
    }

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
