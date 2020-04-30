<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    /**
     * Display the page for the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderDetails = collect([
            'tax' => round($this->getNumbers()->get('newTax'), 2, PHP_ROUND_HALF_UP),
            'toPay' => round($this->getNumbers()->get('newTotal'), 2, PHP_ROUND_HALF_UP)
        ]);

        return view('products.checkout', compact('orderDetails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        try {
            $charges = Stripe::charges()->create([
                'amount' => round($this->getNumbers()->get('newTotal'), 2, PHP_ROUND_HALF_UP),
                'currency' => 'EUR',
                'description' => 'Order',
                'source' => $request->stripeToken,
                'receipt_email' => $request->email,
            ]);

            $this->addToOrdersTables($request, null);

            \Cart::clear();

            return view('products.thankyou');
        } catch (CardErrorException $e) {
            $this->addToOrdersTables($request, $e->getMessage());

            return back()->with('message', 'Error! ' . $e->getMessage());
        }
    }

    /**
     * Save the order in the respective DB tables.
     *
     * @param App\Http\Requests $request
     * @param CardException $error
     */
    protected function addToOrdersTables($request, $error = null)
    {
        $order = Order::create([
                'user_id' => auth()->user() ? auth()->user()->id : null,
                'billing_name' => $request->name,
                'billing_email' => $request->email,
                'billing_address' => $request->address,
                'billing_city' => $request->city,
                'billing_postalcode' => $request->postalcode,
                'billing_country' => $request->country,
                'billing_phone' => $request->phone,
                'billing_name_on_card' => $request->name_on_card,
                'billing_subtotal' => $this->getNumbers()->get('newSubtotal'),
                'billing_tax' => $this->getNumbers()->get('newTax'),
                'billing_total' => $this->getNumbers()->get('newTotal'),
                'error' => $error
            ]);

        $cart = \Cart::getContent();

        foreach ($cart as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity
            ]);
        }
    }

    /**
     * Make the necessary calculations.
     *
     * @return Collection
     */
    private function getNumbers()
    {
        $tax = 0.2;
        $newSubTotal = \Cart::getSubtotal();
        $newTax = $newSubTotal * $tax;
        $newTotal = $newSubTotal * (1 + $tax);

        return collect([
            'tax' => $tax,
            'newSubtotal' => $newSubTotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal
        ]);
    }
}
