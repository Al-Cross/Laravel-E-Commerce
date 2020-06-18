<?php

namespace App;

use App\Category;
use App\AttributeValues;
use App\ProductAttributes;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id', 'name'];

    /**
     * Define the relationship with App\ProductAttributes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttributes::class);
    }

    /**
    * Define the relationship with App\AttributeValues
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function values()
    {
        return $this->hasMany(AttributeValues::class);
    }

    /**
    * Define the relationship with App\Category
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
