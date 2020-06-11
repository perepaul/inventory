<?php

namespace App\Helpers;

use App\Purchase;

class PurchaseHelper
{

    public $purchaseModel;
    public $productHelper;

    public function __construct(Purchase $purcase, ProductHelper $productHelper)
    {
        $this->purchaseModel = $purcase;
        $this->productHelper = $productHelper;
    }

    public function getPurchases()
    {
        return $this->purchaseModel->all();
    }

    public function getPurchase($id)
    {
        return $this->purchaseModel->findOrFail($id);
    }

    public function createPurchase(array $data)
    {
        $product = $this->productHelper->findProduct((int) $data['product_id']);
        $product->update([
            'quantity' => $product->quatity + $data['quantity'],
            'purchase_price' => $data['price'],
        ]);
        return $this->purchaseModel->create($data);
    }
}
