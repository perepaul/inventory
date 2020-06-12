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
    public function getAllProducts($status = 1, $paginate = [])
    {
        $products = $this->productModel->where('status',$status)->orderBy('id','desc')->paginate(1);
        return $products;
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

    public function getLowStockProduct()
    {
        return $this->productModel->whereColumn('alert_quantity','>=','quantity')->paginate(10,['*'],'low_stock');
    }
}
