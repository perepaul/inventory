<?php

namespace App\Http\Controllers;

use App\Purchase;
use Illuminate\Http\Request;
use App\Helpers\PurchaseHelper;

class PurchaseController extends Controller
{
    public $purchaseHelper;
    public function __construct(PurchaseHelper $purchaseHelper)
    {
        $this->purchaseHelper = $purchaseHelper;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = $this->purchaseHelper->getPurchases();
        return view('purchase.index',compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>'required|exists:products,id',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'comment' => 'required|string',
        ],[
            'product_id.required' => "Please select a product",
        ]);

        $this->purchaseHelper->createPurchase(array_merge($request->except('_token'),['user_id'=>auth()->user()->id]));
        session()->flash('message','Purchase Recorded');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = $this->purchaseHelper->getPurchase($id);
        $data['product_name'] = $purchase->product->name;
        $data['comment'] = $purchase->comment;
        $data['quantity'] = $purchase->quantity;
        $data['price'] = $purchase->price;
        $data['user_name'] = $purchase->user->name;

        return response()->json([
            'success'=>true,
            'data'=>$data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
