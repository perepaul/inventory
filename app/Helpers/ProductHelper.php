<?php

namespace App\Helpers;

use App\Product;

class ProductHelper
{
    public $productModel;
    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }
    public function getAllProducts()
    {
        return $this->productModel::all();
    }
    public function findProduct(int $id)
    {
        return $this->productModel::findOrFail($id);
    }
    public function create($data)
    {
        return $this->productModel::create($data);
    }

    public function search(string $term)
    {
        return $this->productModel->where('sku', 'LIKE', "%{$term}%")->orWhere('name', 'LIKE', "%{$term}%")->orderBy('name', 'asc')->get();
    }
}
