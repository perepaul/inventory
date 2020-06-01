<?php

namespace App\Http\Controllers;

use App\Helpers\ProductHelper;
use App\Helpers\SalesHelper;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public $salesHelper;
    public $productHelper;
    public function __construct(SalesHelper $salesHelper, ProductHelper $productHelper)
    {
        $this->salesHelper = $salesHelper;
        $this->productHelper = $productHelper;
    }

    public function index()
    {
        return view('sales.index');
    }

    public function boot()
    {
        return $this->returnRes();
    }

    private function returnRes()
    {
        $sale = $this->salesHelper->sale();
        $markup = '';
        foreach ($sale->sale_items->all() as $saleItem) {
            $markup .= $this->tableRow($saleItem->product, $saleItem->quantity);
        }

        if (empty($markup)) {
            $markup = '<tr><td colspan="5" class="text-center text-muted">Nothing Here!</td></tr>';
        }
        return response()->json([
            'success' => true,
            'data' => $markup
        ]);
    }

    public function search(Request $request)
    {
        $data = [];
        if (empty($request->q)) {
            $products = $this->productHelper->getAllProducts();
        } else {
            $products = $this->productHelper->search($request->q);
        }

        $products->each(function ($item, $key) use (&$data) {
            $data[] = array('id' => $item->id, 'text' => $item->name);
        });
        // $response = [
        //     "resullts" => $data,
        // ];
        return json_encode($data);
    }


    public function addProduct(Request $request)
    {
        // $product = $this->productHelper->findProduct((int) $request->id);
        // dd('here');
        $sale_items = $this->salesHelper->saleQuantityAdapter($request->id, 1);
        if ($sale_items == 'exists') {
            return response()->json([
                'message' => "Product already added to sale",
                'type' => 'warning'
            ], 400);
        }


        return $this->returnRes();
    }

    public function deleteItem($id)
    {
        $deleted = $this->salesHelper->deleteSaleItem($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Item could not be deleted',
                'type' => 'error'
            ], 400);
        }
        return $this->returnRes();
    }

    public function deleteAll()
    {
        $deleted = $this->salesHelper->deleteAll();
        if (!$deleted) {
            return response()->json([
                'succes' => false,
                'message' => 'Nothing to delete',
                'type' => 'error'
            ], 400);
        }
        return  $this->returnRes();
    }

    public function tableRow($product, $quantity = 1)
    {
        $markup = '<tr>';
        $markup .=    '<td>' . $product->name . '</td>';
        $markup .=     '<td>';
        $markup .=    view('partials.select', ['product' => $product]);
        $markup .=     '</td>';
        $markup .=    '<td>' . format_currency($product->price) . '</td>';
        $markup .=    '<td><input type="text" name="discount" value="' . $product->discount . '" class="form-control"></td>';
        $markup .=    '<td>' . format_currency($product->price * $quantity) . '</td>';
        $markup .=    '<td><button onclick="delete_sale_item(' . $product->id . ')" class=" btn text-danger text-lg btn-sm text-sm">&times;</i></button></td>';
        $markup .=    '</tr>';
        return $markup;
    }
}
