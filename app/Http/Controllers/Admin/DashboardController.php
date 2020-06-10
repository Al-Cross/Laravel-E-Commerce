<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Order;
use App\Images;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('email', '!=', config('e-commerce.administrators'))
            ->count();

        $products = Product::count();
        $images = Images::count();
        $orders = Order::count();

        return view('admin.index', compact('users', 'products', 'images', 'orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Product  $product
     * @return \Illuminate\Http\Response
    */
    public function show()
    {
        $users = User::paginate(40);

        return view('admin.users', compact('users'));
    }

    /**
     * Display all closed orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $orders = Order::with('products')->paginate(40);
        $income = $orders->sum('billing_total');

        return view('admin.orders', compact('orders', 'income'));
    }

    /**
     * Find a user in the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $search = request()->input('query');

        $users = User::search($search)->get();

        return view('admin.search', compact('users'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param App\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->back()
            ->with(
                'flash',
                'The user has been successfully removed from the site.'
            );
    }
}
