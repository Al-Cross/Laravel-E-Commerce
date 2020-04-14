<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Defines the relationship with App\Product
     *
     * @return Object
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
