<?php

namespace App\Helpers;

use App\SaleItem;
use App\Sales;

class SalesHelper
{
    public $salesModel;
    public $productHelper;

    public function __construct(Sales $sales, ProductHelper $product)
    {
        $this->salesModel = $sales;
        $this->productHelper = $product;
    }

    public function findSale(int $id): Sales
    {
        return $this->salesModel->findOrFail($id);
    }

    public function getSales()
    {
        //
    }

    public function getUserSale($user)
    {
        //
    }

    public function sale()
    {
        $user = auth()->user();
        $current_sale = $user->sales()->where('status', 0)->first();
        if ($current_sale) return $current_sale;
        $reference_no = generateRefNo();
        while ($this->salesModel::where('reference_no', $reference_no)->get()->count()) {
            $reference_no = generateRefNo();
        }
        $sale = new $this->salesModel([
            'reference_no' => $reference_no
        ]);
        $user->sales()->save($sale);
        return $sale;
    }

    public function addToSale($sale, $product_id, $qty)
    {
        $product = $this->productHelper->findProduct($product_id);
        $saleItem = new SaleItem([
            'product_id' => $product->id,
            'quantity' => $qty,
        ]);

        $sale->sale_items()->save($saleItem);
    }

    public function updateSale($saleItem, $qty)
    {
        $param = ['quantity' => $qty];
        if ($qty > 0) {
            $saleItem->update($param);
        } else {
            $saleItem->delete();
        }
    }

    public function saleQuantityAdapter($product_id, $qty)
    {
        $sale = $this->sale();
        $sale_items = $sale->sale_items()->get();
        $filtered = $sale_items->filter(function ($item) use ($product_id) {
            return $item->product_id == $product_id;
        });
        if (!$filtered->count()) {

            $this->addToSale($sale, $product_id, $qty);
        } else {
            return 'exists';
        }
        return $this->sale()->sale_items;
    }
}
