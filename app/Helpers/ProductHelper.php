<?php

namespace App\Helpers;

use App\Product;
use App\SaleItem;
use Illuminate\Support\Facades\DB;

class ProductHelper
{
    public $productModel;
    public $saleItem;
    public function __construct(Product $product, SaleItem $saleItem)
    {
        $this->productModel = $product;
        $this->saleItem = $saleItem;
    }
    public function getAllProducts($status = 1)
    {
        return $this->productModel::where('status', $status)->orderBy('id', 'desc')->paginate(10);
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
        return $this->productModel->whereColumn('alert_quantity', '>=', 'quantity')->paginate(10, ['*'], 'low_stock');
    }

    public function getBestSellingProducts($limit = 2)
    {
        // return $this->saleItem->groupBy('*')->select('*', \DB::raw('count(product_id) as total'))->get();
        // return $this->saleItem->groupBy('product_id')->count('product_id');
        $basic = DB::select('select product_id,COUNT(product_id) as total_sold, SUM(quantity) as qty from sale_items  group by product_id order by qty desc limit ' . $limit);
        $data = [];
        // dd($basic);
        foreach ($basic as $b) {
            array_push($data, [
                'product' => $this->productModel->where('id', $b->product_id)->first(),
                'total_sold' => $b->qty
            ]);
        }

        return $data;
    }
}
