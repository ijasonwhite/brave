<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariation;

class CartController extends Controller
{

    public static function clearCart()
    {
        session()->forget('cart');
        session()->put('cart_total_price', 0);
    }

    public function index() 
    {
        $cart = session('cart', []);
        $variations = ProductVariation::find(array_keys($cart));
        $totalPrice = session('cart_total_price', 0);

        return view('cart.display', compact('variations', 'cart', 'totalPrice'));
    }

    public function add(Request $request, $variationId)
    {
        // Retrieve the current cart from the session or create a new one if it doesn't exist
        $cart = $request->session()->get('cart', []);

        // Check if the product variation ID exists in the cart
        if (isset($cart[$variationId])) {
            // If it exists, increment the quantity
            $cart[$variationId] += 1;
        } else {
            // If it doesn't exist, add it to the cart with a quantity of 1
            $cart[$variationId] = 1;
        }

        // Store the updated cart back in the session
        $request->session()->put('cart', $cart);

        // Recalculate total price
        $this->updateCartTotalPrice();

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function remove($variationId)
        {
            $cart = session()->get('cart', []);
            if (isset($cart[$variationId])) {
                unset($cart[$variationId]);
            }
            session()->put('cart', $cart);
        
            // Recalculate total price
            $this->updateCartTotalPrice();
        
            return redirect()->back()->with('success', 'Product variation removed from cart!');
        }
    private function updateCartTotalPrice()
        {
            $cart = session()->get('cart', []);
            $totalPrice = 0;
            foreach ($cart as $variationId => $quantity) {
                $variation = ProductVariation::find($variationId);
                $totalPrice += ($variation->price * $quantity);
            }
            session()->put('cart_total_price', $totalPrice);
        }
}
