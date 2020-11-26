<?php

namespace App\Helpers;

use App\Sales;
use App\SaleItem;
use Illuminate\Support\Facades\DB;

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

    public function sale($status = 0,$type = 'retail')
    {
        $user = auth()->user();
        $current_sale = $user->sales()->where('status', $status)->first();
        if ($current_sale) return $current_sale;
        $reference_no = generateRefNo();
        while ($this->salesModel::where('reference_no', $reference_no)->get()->count()) {
            $reference_no = generateRefNo();
        }
        $sale = new $this->salesModel([
            'reference_no' => $reference_no,
            'type'=>$type
        ]);
        $user->sales()->save($sale);
        return $sale;
    }

    public function addToSale($product_id, $unit = 'pieces')
    {
        $sale = $this->sale();
        $product = $this->productHelper->findProduct($product_id);
        $filtered = $this->filterSale($product->id);
        if (!is_null($filtered) && $filtered->count()) {
            return 'exists';
        }
        $newUnit = '';
        foreach(['pieces','carton'] as $un){
            if($product->outOfStock($un)){
                $newUnit = 'out_of_stock';
            }else{
                $newUnit = $un;
            break;
            }
        }
        $saleItem = new SaleItem([
            'product_id' => $product->id,
            'quantity' => 1,
            'unit' => $newUnit
        ]);

        $sale->sale_items()->save($saleItem);
    }

    public function addProductSku($sku)
    {

        $product = $this->productHelper->addProductSku($sku);
        $this->addToSale($product->id);
    }

    public function updateSale($id, $qty)
    {
        $sale = $this->sale();
        $sale_item = $this->filterSale($id);
        if($sale_item->product->outOfStock($sale_item->unit,$qty)){
            return 'insufficient_stock';
        }
        $param = ['quantity' => $qty];
        if ($qty > 0) {
            return  $sale_item->update($param);
        } else {
            return $sale_item->delete();
        }
    }

    public function updateSaleType($type)
    {
        $sale = $this->sale();
        return $sale->update(['type'=>$type]);
    }

    public function deleteSaleItem($id)
    {
        $item = $this->filterSale($id);
        SaleItem::findOrFail($item->id)->delete();
        // return $sale_item->delete();
    }

    public function calculateDiscount(int $discount)
    {
        $sale = $this->sale();
        return $sale->update(['discount'=>$discount]);
    }

    public function changeUnit($id,$unit)
    {
        $sale_item = $this->filterSale($id);
        $product = $sale_item->product;
        if($product->outOfStock($unit)){
            return 'out_of_stock';
        }
        return $sale_item->update(['unit'=>$unit]);
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
        $total = 0;
        $total_cost = 0;
        foreach ($sale->sale_items as $sale_item) {
            $product = $sale_item->product;
            $total += $product->price($sale->type,$sale_item->unit);
            $total_cost += $product->costPrice($sale->type,$sale_item->unit);
            if ($product->outOfStock($sale_item->unit)) $out_of_stock++;
            if ($out_of_stock <= 0) $this->deductQuantity($product,$sale_item);
        }
        if ($out_of_stock > 0) {
            return ['out_of_stock' => true, 'count' => $out_of_stock];
        }
        $total = $total - $sale->discount;
        
        if($total_cost > $total){
            return 'total_mismatch';
        }

        $data['status'] = 1;
        return $sale->update($data);
    }

    private function deductQuantity($product,$item)
    {
        $quantity = '';
        $quantity = $item->unit ==  'pieces' ? 'pieces_stock':'carton_stock';
        $product->$quantity = $product->$quantity - $item->quantity;
       return $product->save();
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

    public function filterSale($id,$unit_id = null)
    {
        $sale = $this->sale();
        $filtered = $sale->sale_items()->where('product_id',$id)->first();

        return $filtered;
    }

    public function bestSellingProducts($limit = 5)
    {
        dd('here');
        $sales = $this->sale(1);
        $products = $sales->sale_items;
        return $products;
    }
}
