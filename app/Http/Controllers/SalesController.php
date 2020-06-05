<?php

namespace App\Http\Controllers;

use App\Helpers\ProductHelper;
use App\Helpers\SalesHelper;
use App\PaymentMethod;
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
        $sale_items = $this->salesHelper->saleQuantityAdapter($request->id, 1);
        if ($sale_items == 'exists') {
            return response()->json([
                'message' => "Product already added to sale",
                'type' => 'warning'
            ], 400);
        }
        return $this->returnRes();
    }

    public function update($id, $quantity)
    {
        $updated = $this->salesHelper->updateSale($id, $quantity);
        if (!$updated) {
            return response()->json([
                'success' => false,
                'message' => 'item failed to update',
                'type' => 'error'
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

    public function checkout(Request $request)
    {
        $request->validate([
            'grand_total' => 'required|numeric',
            'total_discount' => 'required|numeric',
            'payment_method_id' => 'required|numeric'
        ]);
        $checkedout = $this->salesHelper->checkout($request->except('_token'));
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
        $total_discount = 0;
        $grand_total = 0;
        foreach ($sale->sale_items->all() as $saleItem) {
            $total_discount += $saleItem->product->discount * $saleItem->quantity;
            $grand_total += $saleItem->product->price * $saleItem->quantity;
            $markup .= $this->tableRow($saleItem->product, $saleItem->quantity);
        }

        if (empty($markup)) {
            $markup = '<tr><td colspan="5" class="text-center text-muted">Nothing Here!</td></tr>';
        }
        $data = array(
            'html' => $markup,
            'grand_total' => format_currency($grand_total),
            'total_discount' => format_currency($total_discount)
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
        $store_config = storeSettings();
        return view('receipts.index', compact('sale', 'store_config'));
    }
    private function gatherPrintData()
    {
        $lastSale = $this->salesHelper->getUserLastSale();
        return $lastSale->reference_no;
    }
    private function tableRow($product, $quantity = 1)
    {
        $markup = '<tr id="' . $product->id . '">';
        $markup .=    '<td>' . $product->name . '</td>';
        $markup .=     '<td>';
        $markup .=    view('partials.select', ['product' => $product, 'value' => $quantity]);
        $markup .=     '</td>';
        $markup .=    '<td>' . format_currency($product->price) . '</td>';
        $markup .=    '<td><input type="text" name="discount" value="' . $product->discount * $quantity . '" class="form-control onlydigits"></td>';
        $markup .=    '<td>' . format_currency($product->price * $quantity) . '</td>';
        $markup .=    '<td><button onclick="delete_sale_item(' . $product->id . ')" class=" btn text-danger text-lg btn-sm text-sm">&times;</i></button></td>';
        $markup .=    '</tr>';
        return $markup;
    }
}
