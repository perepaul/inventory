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
        return $this->productModel->orderBy('id','desc')->paginate(30);
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

    public function addProductSku($sku)
    {
        return $this->productModel->where('sku', $sku)->firstOrFail();
    }
}
