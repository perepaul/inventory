<?php

namespace App\Http\Controllers;

use App\Helpers\ProductHelper;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public $productHelper;

    public function __construct(ProductHelper $productHelper)
    {
        $this->productHelper = $productHelper;
    }
    public function inventory()
    {
        $active_products = $this->productHelper->getAllProducts();
        $disabled_products = $this->productHelper->getAllProducts(1);
        $low_stock_products = $this->productHelper->getLowStockProduct();
        return view('reports.product',compact('active_products','disabled_products','low_stock_products'));
    }

    public function sales()
    {
        return view('reports.sales');
    }

    public function purchase()
    {
        return view('reports.purchase');
    }

    public function profitLoss()
    {
        return view('reports.profit-loss');
    }
}
