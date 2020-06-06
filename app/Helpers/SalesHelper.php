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
        // dd(auth()->guest());
        // if (auth()->user()) {
        //     session()->flash('error', 'Please you have to be logged-in to the application to continue.');
        //     abort(401);
        // }
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

    public function addToSale($product_id, $qty)
    {
        $sale = $this->sale();
        $product = $this->productHelper->findProduct($product_id);
        if ($this->filterSale($product_id)->count() > 1) {
            dd($this->filterSale($product_id));
            return 'exists';
        }

        if ($product->quantity <= 0) {
            return 'out_of_stock';
        }
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

    public function checkout($data)
    {
        $sale = $this->sale();
        if ($sale->sale_items()->get()->count() <= 0) {
            return false;
        }
        $out_of_stock = 0;
        foreach ($sale->sale_items as $sale_item) {
            $product = $sale_item->product;
            if ($product->quantity <= 0) $out_of_stock++;
            if ($out_of_stock <= 0) $product->update(['quantity' => ($product->quantity - $sale_item->quantity)]);
        }
        if ($out_of_stock > 0) {
            return ['out_of_stock' => true, 'count' => $out_of_stock];
        }
        $data['status'] = 1;
        return $sale->update($data);
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

    public function getUserLastSale()
    {
        $user = auth()->user();

        $lastSale = $user->sales()->where('status', 1)->orderBy('id', 'desc')->first();
        return $lastSale;
    }

    public function gatherPrintData($reference_no)
    {
        return $this->salesModel->where('reference_no', $reference_no)->first();
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
