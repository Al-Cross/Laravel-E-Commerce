<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductAttributes extends Pivot
{
    protected $table = 'product_attributes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'attr_value_id'];
}
