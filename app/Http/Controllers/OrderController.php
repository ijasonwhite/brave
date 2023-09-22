<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function history() {
        // Fetch orders for the authenticated user
        $orders = auth()->user()->orders()->with('orderItems.productVariation.product')->get();

        return view('orders.history', compact('orders'));
    }
}
