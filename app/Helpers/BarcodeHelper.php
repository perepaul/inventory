<?php

namespace App\Helpers;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use CodeItNow\BarcodeBundle\Utils\QrCode;


class BarcodeHelper
{

    public function create()
    {
        $qrCode = new QrCode();
        $barcode = new BarcodeGenerator();
        $barcode->setText("615110003153");
        $barcode->setType(BarcodeGenerator::Ean13);
        $barcode->setScale(2);
        $barcode->setThickness(20);
        $barcode->setFontSize(10);
        return $code = $barcode->generate();
        return $barcode;

        echo '<img src="data:' . $qrCode->getContentType() . ';base64,' . $qrCode->generate() . '" />';
    }

    public function read()
    {
    }
}
