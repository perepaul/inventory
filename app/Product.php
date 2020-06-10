<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'sku',
        'name',
        'quantity',
        'alert_quantity',
        'purchase_price',
        'price',
        'discount',
        'image',
        'status'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
