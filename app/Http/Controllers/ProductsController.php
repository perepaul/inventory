<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Product;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Helpers\ProductHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductsController extends Controller
{

    public $productHelper;

    public function __construct(ProductHelper $productHelper)
    {
        $this->productHelper = $productHelper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productHelper->getAllProducts();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateReq($request);
        // dd($request->all());
        $req = $request->except('_token', 'status', 'image','unit');
        $req['image'] = uploadFile($request->file('image'), public_path(config('constants.product_image_path'))) ?? config('contants.default_image');
        $req['status'] = getStatus($request->status);

        $this->productHelper->create($req);
      
        session()->flash('message', 'Inventory added successfully');
        return redirect()->route('inventories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product =  $this->productHelper->findProduct((int) $id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateReq($request, true, $id);
        // dd($request->all());
        $product = $this->productHelper->findProduct((int) $id);
        $req = $request->except('_token', 'status', 'image', '_method');
        $req['image'] = uploadFile($request->file('image'), public_path(config('constants.product_image_dir')), $product->image);
        $req['status'] = getStatus($request->status);
        // dd($req);
        $product->update($req);
        session()->flash('message', 'Inventory Updated');
        return redirect()->route('inventories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productHelper->findProduct((int) $id);
        deleteFile(public_path(config('constants.product_image_dir')), $product->image);
        $product->delete();
        session()->flash('message', 'Inventory Deleted');
        return redirect()->route('inventories.index');
    }

    private function validateReq(Request $request, $update = false, $ignore_id = null)
    {
        $uniqueRule = (($update) && !is_null($ignore_id)) ? "unique:products,sku,{$ignore_id}|" : "unique:products|";
        $sometimes = ($update) ? 'sometimes|' : '';
        // dd($uniqueRule);

        // dd($uniqueRule);
        return $request->validate(
            [
                'sku' => $sometimes . $uniqueRule . 'required',
                'name' => 'required|string',
                'description' =>'required|string', 
                'image'  => 'sometimes|mimes:jpeg,jpg,png',
                //pieces section
                'pieces_retail_price' => 'required|integer',
                'pieces_wholesale_price' => 'required|integer',
                'pieces_cost_price' => 'required|integer',
                'pieces_stock' => 'required|integer',
                'pieces_alert_quantity' => 'required|integer',
                //carton section
                'carton_retail_price' => 'required|integer',
                'carton_wholesale_price' => 'required|integer',
                'carton_cost_price' => 'required|integer',
                'carton_stock' => 'required|integer',
                'carton_alert_quantity' => 'required|integer',

            ],
            [
                'unique' => 'A product already exist with that :attribute',
                'integer' => 'The :attribute must be numbers',
            ]
        );
    }
}
