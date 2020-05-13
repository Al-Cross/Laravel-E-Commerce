<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Http\Request;
use App\Exceptions\ItemInWishlistException;

class WishlistController extends Controller
{
    public function index($userId)
    {
        $wishlist = Wishlist::where('user_id', '=', $userId)
            ->orderBy('id', 'desc')
            ->paginate(20);
        $products = $wishlist->load(['product', 'product.images']);

        if (request()->wantsJson()) {
            return $products;
        }

        return view('users.wishlist', compact('wishlist'));
    }

    public function store($userId)
    {
        try {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => request()->productId
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->back()
                ->with('error', 'This item is already in your wishlist.');
        }
    }

    public function destroy($userId, $productId)
    {
        $item = Wishlist::where('product_id', '=', $productId)->first();

        $item->delete();

        return redirect()
            ->back()
            ->with('message', 'Removed successfully from the wishlist.');
    }
}
