<?php

namespace App;

use App\Product;
use App\Attribute;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    /**
     * Define the relationship with App\Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Define the relationship with App\Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
