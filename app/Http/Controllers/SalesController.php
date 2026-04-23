<?php

namespace App\Http\Controllers;

use App\Models\Sale;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sale::orderBy('sale_date', 'desc')->paginate(20);

        return view('admin.sales.index', compact('sales'));
    }
}
