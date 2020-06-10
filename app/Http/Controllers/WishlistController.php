<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Http\Request;
use App\Exceptions\ItemInWishlistException;

class WishlistController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        $wishlist = Wishlist::where('user_id', '=', $userId)
            ->orderBy('id', 'desc')
            ->paginate(20);

        $products = $wishlist->load(['product', 'product.images']);
        // dd($products);
        if (request()->wantsJson()) {
            return $products;
        }

        return view('users.wishlist', compact('wishlist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  integer $userId
     * @return \Illuminate\Http\Response
     */
    public function store($userId)
    {
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => request()->productId
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $userId
     * @param  integer $productId
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, $productId)
    {
        $item = Wishlist::where('product_id', '=', $productId)->first();

        $item->delete();

        return redirect()
            ->back()
            ->with('flash', 'Removed successfully from the wishlist.');
    }
}
