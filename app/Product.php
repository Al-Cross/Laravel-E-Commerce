<?php

namespace App;

use App\Images;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
     * Define the relationship with App\ProductAttributes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes()
    {
        return $this->hasMany(ProductAttributes::class);
    }
}
