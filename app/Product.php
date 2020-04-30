<?php

namespace App;

use App\Images;
use App\Category;
use App\AttributeValues;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'description', 'price', 'quantity'];

    /**
     * The URL to the resource.
     *
     * @return string
     */
    public function path()
    {
        return "/products/{$this->category->slug}/{$this->slug}";
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

    /**
     * Define the relationship with App\Images
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Images::class);
    }

    /**
     * Define the relationship with App\AttributeValues
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes()
    {
        return $this->belongsToMany(AttributeValues::class, 'product_attributes', 'product_id', 'attr_value_id');
    }

    /**
     * Get the path to the main product image.
     *
     * @return string
     */
    public function mainImage()
    {
        return $this->images->where('product_id', $this->id)->first()->path;
    }

    /**
     * Add the product to the card.
     *
     * @param Illuminate\Http\Request $price
     * @param Illuminate\Http\Request $quantity
     */
    public function addToCart($price, $quantity)
    {
        \Cart::add($this->id, $this->name, $price, $quantity);
    }
}
