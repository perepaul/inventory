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

    public function updateSale($id, $qty)
    {
        $sale_item = $this->filterSale($id);
        $param = ['quantity' => $qty];
        if ($qty > 0) {
            return  $sale_item->first()->update($param);
        } else {
            return $sale_item->delete();
        }
    }

    public function deleteSaleItem($id)
    {
        $sale_item = $this->filterSale($id);
        return $sale_item->first()->delete();
    }

    public function deleteAll()
    {
        $sale = $this->sale();
        $sale_items = $sale->sale_items()->get();
        if ($sale_items->count() < 1) {
            return false;
        }
        $sale_items->each(function ($item, $index) {
            $item->delete();
        });
        return true;
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

    public function getUserSaleItem($id)
    {
        return $this->filterSale($id);
    }

    public function filterSale($id)
    {
        $sale = $this->sale();
        $sale_items = $sale->sale_items()->get();

        $filtered = $sale_items->filter(function ($item) use ($id) {
            return $item->product_id == $id;
        });

        return $filtered;
    }
}
