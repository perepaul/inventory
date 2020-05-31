<?php

namespace App\Helpers;

use App\Sales;

class SalesHelper
{
    public $salesModel;

    public function __construct(Sales $sales)
    {
        $this->salesModel = $sales;
    }

    public function findSale(int $id): Sales
    {
        return $this->salesModel->findOrFail($id);
    }

    public function getSales()
    {
        //
    }

    public function getUserSale($user)
    {
        //
    }
}
