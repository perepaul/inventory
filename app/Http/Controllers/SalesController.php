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
        $sale = $this->salesHelper->sale();
        $markup = '';
        foreach ($sale->sale_items->all() as $saleItem) {
            $markup .= $this->tableRow($saleItem->product, $saleItem->quantity);
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
        $markup = '';
        foreach ($sale_items->all() as $saleItem) {
            $markup .= $this->tableRow($saleItem->product, $saleItem->quantity);
        }

        return response()->json([
            'success' => true,
            'data' => $markup
        ]);
    }

    public function tableRow($product, $quantity = 1)
    {
        // dd($product->name);
        // dd(format_currency($product->price));


        $markup = '<tr>';
        $markup .=    '<td class="p-2">' . $product->name . '</td>';
        $markup .=     '<td class="p-2">';
        $markup .=    view('partials.select', ['product' => $product]);
        $markup .=     '</td>';
        $markup .=    '<td class="p-2">' . format_currency($product->price) . '</td>';
        $markup .=    '<td class="p-2"><input type="text" name="discount" value="' . $product->discount . '" class="form-control"></td>';
        $markup .=    '<td class="p-2">' . format_currency($product->price * $quantity) . '</td>';
        $markup .=    '<td class="p-2"><button class=" btn text-danger text-lg btn-sm text-sm">&times;</i></button></td>';
        $markup .=    '</tr>';
        return $markup;
    }
}
