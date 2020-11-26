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

    public function stock($unit = null)
    {
        if($unit == 'carton'){
            return  $this->carton_stock;
        }elseif($unit == 'pieces')
        {
            return $this->pieces_stock;
        }
        return $this->pieces_stock + $this->carton_stock;
    }

    public function outOfStock($unit = null, $quantity = 1)
    {
        return $this->stock($unit) < $quantity;
    }

    public function price($type = 'retail',$unit = 'pieces')
    {
        $retail_price = '';
        $wholesale_price = '';
        if($unit == 'pieces')
        {
            $retail_price = $this->pieces_retail_price;
            $wholesale_price = $this->pieces_wholesale_price;
        }else{
            $retail_price = $this->carton_retail_price;
            $wholesale_price = $this->carton_wholesale_price;
        }

        return $type == 'retail' ? $retail_price : $wholesale_price;
    }

    public function costPrice($type = 'retail',$unit = 'pieces')
    {
        $retail_price = '';
        $wholesale_price = '';
        if($unit == 'pieces')
        {
            $retail_price = $this->pieces_cost_price;
            $wholesale_price = $this->pieces_cost_price;
        }else{
            $retail_price = $this->carton_cost_price;
            $wholesale_price = $this->carton_cost_price;
        }

        return $type == 'retail' ? $retail_price : $wholesale_price;
    }
}
