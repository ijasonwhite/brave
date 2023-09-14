<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
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
