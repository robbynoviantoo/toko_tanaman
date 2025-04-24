<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductViewController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('user.products.index', compact('products'));
    }
}