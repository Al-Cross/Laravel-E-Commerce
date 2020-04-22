<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    protected $table = 'product_attributes';
    protected $fillable = ['product_id', 'attr_value_id'];
}
