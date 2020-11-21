<?php

namespace App\Http\Controllers;

use App\Helpers\ProductHelper;
use App\Helpers\PurchaseHelper;
use App\Helpers\SalesHelper;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public $productHelper;
    public $purchaseHelper;

    public function __construct(ProductHelper $productHelper, PurchaseHelper $purchaseHelper)
    {
        $this->productHelper = $productHelper;
        $this->purchaseHelper = $purchaseHelper;
    }
    public function inventory()
    {
        $active_products = $this->productHelper->getAllProducts(1);
        $disabled_products = $this->productHelper->getAllProducts(0);
        $low_stock_products = $this->productHelper->getLowStockProduct();
        $best_selling = $this->productHelper->getBestSellingProducts();
        // dd($this->salesHelper->bestSellingProducts());
        // dd($best_selling);
        return view('reports.product', compact('active_products', 'disabled_products', 'low_stock_products', 'best_selling'));
    }

    public function sales()
    {
        return view('reports.sales');
    }

    public function purchase()
    {
        $purchases = $this->purchaseHelper->getPurchases();
        return view('reports.purchase', compact('purchases'));
    }

    public function profitLoss()
    {
        return view('reports.profit-loss');
    }
}
