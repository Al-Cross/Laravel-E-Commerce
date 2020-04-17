<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    /**
     * Define the relationship with App\Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
