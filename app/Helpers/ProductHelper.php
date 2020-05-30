<?php

namespace App\Helpers;

use App\Product;

class ProductHelper
{
    public function getAllProducts()
    {
        return Product::all();
    }
    public function findProduct(int $id)
    {
        return Product::findOrFail($id);
    }
    public function create($data)
    {
        return Product::create($data);
    }
}
