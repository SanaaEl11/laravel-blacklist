<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['entreprise', 'typeProduct'])->paginate(10);
        return view('admin.listProducts', compact('products'));
    }
}
