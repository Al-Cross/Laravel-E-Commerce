<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValues extends Model
{
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
}
