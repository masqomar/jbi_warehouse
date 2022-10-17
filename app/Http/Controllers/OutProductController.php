<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OutProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('out-products.index', compact('products'));
    }
}
