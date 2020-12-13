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
    public $salesHelper;

    public function __construct(ProductHelper $productHelper, PurchaseHelper $purchaseHelper, SalesHelper $salesHelper)
    {
        $this->productHelper = $productHelper;
        $this->purchaseHelper = $purchaseHelper;
        $this->salesHelper = $salesHelper;
    }
    public function inventory(Request $request)
    {
        $active_products = $this->productHelper->getAllProducts(1, false, $request->all());
        // $active_products = $active_products->whereDate('created_at',now());
        $disabled_products = $this->productHelper->getAllProducts(0);
        $low_stock_products = $this->productHelper->getLowStockProduct();
        $best_selling = $this->productHelper->getBestSellingProducts();
        $low_stock_count = $this->productHelper->getLowStockCount();
        $total_products = $this->productHelper->getTotalProductCount();
        $total_active_products = $this->productHelper->getTotalProductCount(1);
        $total_inactive_products = $this->productHelper->getTotalProductCount(0);

        return view(
            'reports.product',
            compact(
                'total_products',
                'total_active_products',
                'total_inactive_products',
                'low_stock_count',
                'active_products',
                'disabled_products',
                'low_stock_products',
                'best_selling'
            )
        );
    }

    public function sales()
    {
        $sales = $this->salesHelper->getSales();
        return view(
            'reports.sales',
            compact('sales')
        );
    }

    public function purchase()
    {
        $purchases = $this->purchaseHelper->getPurchases();
        return view('reports.purchase', compact('purchases'));
    }

    // public function profitLoss()
    // {
    //     return view('reports.profit-loss');
    // }
}
