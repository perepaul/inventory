<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function outOfStock()
    {
        // return $this->units()->sum('product_unit.stock') < 0;
    }
}
