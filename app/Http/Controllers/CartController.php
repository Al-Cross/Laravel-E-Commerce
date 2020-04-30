<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $cartContents = \Cart::getContent();

        return view('products.cart', compact('cartContents'));
    }

    public function update($id)
    {
        $validator = Validator::make(request()->all(), [
            'quantity' => ['required', 'numeric', 'between:1,5']
        ]);

        if ($validator->fails()) {
            session()->flash('error', "Quantity must be between 1 and 5.");
            return response()->json(['success' => false], 400);
        }

        \Cart::update($id, ['quantity' => [
            'relative' => false,
            'value' => request()->quantity
            ]]);

        session()->flash('message', 'Quantity was updated successfully.');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Cart::isEmpty()) {
            return redirect('/');
        }

        \Cart::remove($id);

        return redirect()
                ->back()
                ->with('message', 'Item removed from cart successfully.');
    }

    /**
     * Remove all items from the cart
     *
     * @return \Illuminate\Http\Response
     */
    public function clearCart()
    {
        \Cart::clear();

        return redirect('/products');
    }
}
