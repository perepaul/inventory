<?php

namespace App\Http\Controllers;

use Throwable;
use App\PaymentMethod;
use App\Helpers\SalesHelper;
use Illuminate\Http\Request;
use App\Helpers\ProductHelper;
use Illuminate\Support\Facades\Log;

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
        $payment_methods = PaymentMethod::all();
        return view('sales.index', compact('payment_methods'));
    }

    public function boot()
    {
        return $this->returnRes();
    }


    public function search(Request $request)
    {
        $data = [];
        if (!empty($request->q)) {
            $products = $this->productHelper->search($request->q);
            $products->each(function ($item, $key) use (&$data) {
                $data[] = array('data' => $item->id, 'value' => $item->name);
            });
        }

        $response = [
            "suggestions" => $data,
        ];
        return json_encode($response);
    }


    public function addProduct(Request $request)
    {
        // dd($request->all());
        // dd($request->all());
        $sale_items = $this->salesHelper->addToSale($request->id);
        if ($sale_items == 'exists') {
            return response()->json([
                'message' => "Product already added to sale",
                'type' => 'warning'
            ], 400);
        } elseif ($sale_items == 'out_of_stock') {
            return response()->json([
                'message' => "Product out of stock",
                'type' => 'warning'
            ], 400);
        }
        return $this->returnRes();
    }

    public function addProductSku(Request $request)
    {
        $sale_items = $this->salesHelper->addProductSku($request->sku);
        if ($sale_items == 'exists') {
            return response()->json([
                'message' => "Product already added to sale",
                'type' => 'warning'
            ], 400);
        } elseif ($sale_items == 'out_of_stock') {
            return response()->json([
                'message' => "Product out of stock",
                'type' => 'warning'
            ], 400);
        }
        return $this->returnRes();
    }

    public function update($id, $quantity)
    {
        $updated = $this->salesHelper->updateSale($id, $quantity);
        if($updated === 'insufficient_stock'){
            return response()->json([
                'success' => false,
                'message' => 'Available stocks are less than '.$quantity,
                'type' => 'error'
            ], 400);
        }
        if (!$updated) {
            return response()->json([
                'success' => false,
                'message' => 'item failed to update',
                'type' => 'error'
            ], 400);
        }
        return $this->returnRes();
    }

    public function updateSaleType($type)
    {
        if(!in_array($type,['retail','wholesale'])){
            return response()->json([
                'success' => false,
                'message' => 'unsupported sale type detected!',
                'type' => 'warning'
            ], 400);
        }
        if(!$this->salesHelper->updateSaleType($type))
        {
            return response()->json([
                'success' => false,
                'message' => 'unable to update sale type!',
                'type' => 'error'
            ], 400);
        }
        return $this->returnRes();
    }

    public function deleteItem($id)
    {
        try{
            $this->salesHelper->deleteSaleItem($id);
        }catch(\Throwable $e){
            Log::error($e);
            return response()->json([
                'success' => false,
                'message' => 'Item could not be deleted',
                'type' => 'error'
            ], 400);
        }

        return $this->returnRes();
    }

    public function calculateDiscount($discount)
    {
        if(empty($discount)){
            $discount = 0;
        }
        try{
            $this->salesHelper->calculateDiscount($discount??0);
        }catch(\Throwable $e){
            Log::error($e);
            return response()->json([
                'success' => false,
                'message' => 'Discount couldn\'t be applied',
                'type' => 'error'
            ], 400);
        }

        return $this->returnRes();
    }

    public function changeUnit($id,$unit)
    {
        if(!in_array($unit,['pieces','carton'])){
            return response()->json([
                'succes' => false,
                'message' => 'Unsupported unit detected!',
                'type' => 'error'
            ], 400);
        }

    
           $response = $this->salesHelper->changeUnit($id,$unit);
        //    dd($response);
           if($response === 'out_of_stock'){
            return response()->json([
                'succes' => false,
                'message' => 'Item out of '.$unit.' stock',
                'type' => 'error'
            ], 400);
           }elseif($response == false){
               return response()->json([
                   'succes' => false,
                   'message' => 'Failed to update sale item unit!',
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

    public function checkout(Request $request)
    {
        $request->validate([
            'total' => 'required|numeric',
            'total_discount' => 'required|numeric',
            'payment_method_id' => 'required|numeric'
        ]);
        $data = $request->only('payment_method_id');
        $data['discount'] = $request->total_discount;
        $data['total'] = $request->total;
        // dd($data);
        $checkedout = $this->salesHelper->checkout($data);
        if (is_array($checkedout)) {
            $plural = ($checkedout['count'] > 1) ? 's are ' : ' is ';
            return response()->json([
                'succes' => false,
                'message' => $checkedout['count'] . ' Product' . $plural . 'out of stock',
                'type' => 'warning'
            ], 400);
        }
        if($checkedout === 'total_mismatch'){
            return response()->json([
                'succes' => false,
                'message' => 'Total sale cannot be lower than total cost price',
                'type' => 'warning'
            ],400);
        }
        if (!$checkedout) {
            return response()->json([
                'succes' => false,
                'message' => 'Add items to sale before checking out',
                'type' => 'error'
            ], 400);
        }

        return $this->returnRes(true);
    }

    private function returnRes($checkout = false)
    {

        $sale = $this->salesHelper->sale();
        $markup = '';
        $discount = $sale->discount ?? 0;
        $total = 0;
        foreach ($sale->sale_items->all() as $saleItem) {
            $quantity = $saleItem->quantity;
            $price = $saleItem->product->price($sale->type,$saleItem->unit);
            $total += ($price * $quantity);
            $markup .= $this->tableRow($saleItem,$price,$quantity);
        }

        if (empty($markup)) {
            $markup = '<tr><td colspan="5" class="text-center text-muted">Nothing Here!</td></tr>';
        }
        $data = array(
            'html' => $markup,
            'total' => format_currency($total - $discount),
            'sub_total' => format_currency($total),
            'type'=>$sale->type,
            'discount' => $discount
        );
        if ($checkout) {
            $printData = $this->gatherPrintData();
            $data['receipt_ref'] = $printData;
        }
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function printRecept($reference_no)
    {
        $sale = $this->salesHelper->gatherPrintData($reference_no);
        $payment_method = PaymentMethod::where('id', $sale->payment_method_id)->first();
        $store_config = storeSettings();
        return view('receipts.index', compact('sale', 'store_config', 'payment_method'));
    }
    private function gatherPrintData()
    {
        $lastSale = $this->salesHelper->getUserLastSale();
        return $lastSale->reference_no;
    }
    private function tableRow($saleItem,$price, $quantity = 1)
    {
        $product = $saleItem->product;
        $ctn = $pcs = '';
        $saleItem->unit == 'carton'?$ctn = 'selected':$pcs = 'selected';
        $markup = '<tr id="' . $product->id . '">';
        $markup .=    '<td>' . $product->name . '</td>';
        $markup .=     '<td>';
        $markup .=    view('partials.select', ['product' => $product, 'value' => $quantity,'unit'=>$saleItem->unit]);
        $markup .=     '</td>';
        $markup .=    '<td>' . format_currency($price) . '</td>';
        $markup .=    '<td>';
                    $markup .= '<select name="unit" class="form-control" onchange="changeUnit('.$product->id.',this)">';
                        $markup .= "<option value='pieces' {$pcs}>Pieces(pcs)</option>";
                        $markup .= "<option value='carton' {$ctn}>Carton(ctn)</option>";
                    $markup .= '</select>';
        $markup .=    '</td>';
        // $markup .=    '<td><input type="text" name="discount" value="' . $product->discount * $quantity . '" class="form-control onlydigits no-input"></td>';
        $markup .=    '<td>' . format_currency($price * $quantity) . '</td>';
        $markup .=    '<td><button onclick="delete_sale_item(' . $product->id . ')" class=" btn text-danger text-lg btn-sm text-sm">&times;</i></button></td>';
        $markup .=    '</tr>';
        return $markup;
    }
}
