<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $orders = $user->orders()->with('products')->get();

        return view('users.orders', compact('user', 'orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if (auth()->user()->id != $order->user_id) {
            return back()->with(
                'flash',
                'You do not have permission to view this order!'
            );
        }

        $products = $order->products()->get();

        return view('users.order_details', compact('order', 'products'));
    }
}
