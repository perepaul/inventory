<?php

namespace App\Helpers;

use App\Product;
use App\SaleItem;
use Carbon\Carbon;
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
    public function getAllProducts($status = null,$paginate = false,$filters = [])
    {
        $products = '';
        if(!is_null($status))
            $products = $this->productModel::where('status', $status)->orderBy('id', 'desc');
        else
            $products = $this->productModel::orderBy('id', 'desc');

        // $products->whereDate('created_at','<=',now()->toDateString())->whereDate('created_at','>=',now()->addDay(1)->toDateString());
        // dd('after the products');
        if(isset($filters['start_date']) && isset($filters['end_date'])){
            $start = Carbon::parse($filters['start_date']);
            $end = Carbon::parse($filters['end_date']);
            if($start->greaterThan($end)){
                $products->whereDate('created_at','>=',$start->toDateString())->whereDate('created_at','<=',$end->toDateString());
            }
        }





        if($paginate)
            return $products->paginate(10);
        else
            return $products->get();
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
        return $this->productModel->whereColumn('pieces_stock', '<=', 'pieces_alert_quantity')->orWhereColumn('carton_stock', '<=', 'carton_alert_quantity')->paginate(10, ['*'], 'low_stock');
        return [];
    }
    public function getLowStockCount()
    {
        return $this->productModel->whereColumn('pieces_stock','<=','pieces_alert_quantity')->count();
    }
    public function getTotalProductCount($status = null)
    {
        if(!is_null($status))
        return $this->productModel->where('status',$status)->count();
        else
        return $this->productModel->count();
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
