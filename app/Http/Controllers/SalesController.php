<?php

namespace App\Http\Controllers;

use App\Helpers\SalesHelper;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public $salesHelper;
    public function __construct(SalesHelper $salesHelper)
    {
        $this->salesHelper = $salesHelper;
    }

    public function index()
    {
        return view('sales.index');
    }

    public function tableRow($data)
    {
        return '<tr>' +
            '<td class="p-2">Name</td>' +
            '<td class="p-2">' +
            '@include("partials.select")' +
            '</td>' +
            '<td class="p-2">₦300000</td>' +
            '<td class="p-2"><input type="text" name="discount" class="form-control"></td>' +
            '<td class="p-2">₦30000</td>' +
            '<td class="p-2"><buttonclass=" btn btn-danger btn-sm text-sm">&times;</i></button></td>' +
            '</tr>';
    }
}
