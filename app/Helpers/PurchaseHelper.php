<?php

namespace App\Helpers;
use App\Purchase;

class PurchaseHelper{

    public $purchaseModel;

    public function __construct(Purchase $purcase)
    {
        $this->purchaseModel = $purcase;
    }

    public function getPurchases()
    {
        return $this->purchaseModel->all();
    }

    public function getPurchase($id){
        return $this->purchaseModel->findOrFail($id);
    }

    public function createPurchase(array $data)
    {
        // dd($data);
        return $this->purchaseModel->create($data);
    }
}
