<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    // Method to display the checkout form
    public function index()
    {
        $cart = session('cart', []);
        $variations = ProductVariation::find(array_keys($cart));
        $totalPrice = session('cart_total_price', 0);

        return view('checkout.index', compact('variations', 'cart', 'totalPrice'));
    }

    // Method to process the checkout form submission
    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'postcode' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);
        $cartItems = session('cart', []);
        $variations = ProductVariation::find(array_keys($cartItems))->keyBy('id');
        $totalPrice = session('cart_total_price', 0);

        // Create a new order
            $order = Order::create([
                'user_id' => auth()->id(),
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'address1' => $data['address1'],
                'address2' => $data['address2'],
                'postcode' => $data['postcode'],
                'city' => $data['city'],
                'country' => $data['country'],
                'total' => $totalPrice
            ]);

            $total = 0;
            foreach ($cartItems as $key=>$value) {
                $variation = $variations[$key];
                $price = $variation->price;

                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_variation_id' => $key,
                    'quantity' => $value,
                    'price' => $price, //    save it in case the price changes
                ]);
            }
        
        CartController::clearCart();

        return redirect()->route('orders.history');
    }
}
