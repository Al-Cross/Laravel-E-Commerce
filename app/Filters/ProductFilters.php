<?php

namespace App\Filters;

use Illuminate\Support\Facades\DB;

class ProductFilters extends Filters
{
    /**
     * Filter the products according to their price.
     *
     * @return Eloquent query
     */
    public function price()
    {
        if ($this->request->price == 'desc') {
            return $this->builder->orderBy('price', 'desc');
        } elseif ($this->request->price == 'asc') {
            return $this->builder->orderBy('price', 'asc');
        }
    }

    /**
     * Select the bestselling products.
     *
     * @return Eloquent query
     */
    public function demand()
    {
        if ($this->request->demand) {
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
                return $this->builder->findMany($product);
            } else {
                return redirect()
                    ->back()
                    ->with(
                        'message',
                        'No hot items yet. Be the first to take the lead!'
                    );
            }
        }
    }
}
