<?php

namespace App\Http\Controllers;


use App\Helpers\BarcodeHelper;
use Illuminate\Http\Request;

class BardcodesController extends Controller
{
    public $barcodeHelper;

    public function __construct()
    {
        // $this->barcodeHelper = $barcode;
    }

    public function create()
    {
        $qrCode = new BarcodeHelper();
        $code = $qrCode->create();
        return '<img src="data:image/png;base64,' . $code . '" />';;
    }
}
