<?php

namespace App;

use App\Product;
use App\Attribute;
use App\ProductAttributes;
use Illuminate\Database\Eloquent\Model;

class AttributeValues extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['attribute_id', 'value'];

    /**
     * Define the relationship with App\Attribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * Define the relationship with App\Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsToMany(
            Product::class,
            'product_attributes',
            'attr_value_id',
            'product_id'
        );
    }
}
