<?php

namespace App\Http\Controllers\Admin;

use App\User;
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

        return view('admin.index', compact('users', 'products', 'images'));
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function show()
    {
        $users = User::paginate(40);

        return view('admin.users', compact('users'));
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
                'message',
                'The user has been successfully removed from the site.'
            );
    }
}
