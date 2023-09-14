<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with(['variations' => function ($query) {
            $query->orderBy('price', 'asc');
        }])->get()->sortBy(function ($product) {
            return $product->variations->min('price');
        }); 
        return view('products.index', compact('products'));
    }
}
