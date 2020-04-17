<?php

namespace App;

use App\Category;
use App\AttributeValues;
use App\ProductAttributes;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['category_id', 'name'];

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttributes::class);
    }

    public function values()
    {
        return $this->hasMany(AttributeValues::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
