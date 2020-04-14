<?php

namespace App;

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
     * Defines the relationship with App\Category
     *
     * @return Object
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
