<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'billing_name', 'billing_email', 'billing_address', 'billing_city', 'billing_country', 'billing_postalcode', 'billing_phone', 'billing_name_on_card', 'billing_subtotal', 'billing_tax', 'billing_total', 'payment_gateway', 'shipped', 'error'];

    /**
     * Define the relationship with App\User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship with App\Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
