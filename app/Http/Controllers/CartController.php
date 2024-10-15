<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;

class CartController extends Controller
{
    // Initialize an empty cart or get the current cart session
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Add a product to the cart
    public function addToCart(Request $request, $p_id)
    {
        $product = Produk::find($p_id);
        
        if (!$product) {
            return redirect()->route('cart.index')->with('error', 'Product not found.');
        }

        // Retrieve the cart from the session, or initialize an empty array if not present
        $cart = session()->get('cart', []);

        // If product already exists in the cart, increment quantity
        if (isset($cart[$p_id])) {
            $cart[$p_id]['quantity']++;
        } else {
            // Add the product to the cart with quantity 1
            $cart[$p_id] = [
                'name' => $product->p_nama,
                'price' => $product->p_harga,
                'quantity' => 1,
            ];
        }

        // Store the updated cart in the session
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    // Remove an item from the cart
    public function removeFromCart(Request $request, $p_id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$p_id])) {
            unset($cart[$p_id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    public function decrease($p_id)
    {
        $cart = session()->get('cart');

        if ($cart[$p_id]['quantity'] > 1) {
            $cart[$p_id]['quantity']--;
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Quantity decreased');
    }

    // Increase quantity
    public function increase($p_id)
    {
        $cart = session()->get('cart');

        // Optionally, you can check if stock is available before increasing
        $product = produk::find($p_id);
        if ($cart[$p_id]['quantity'] < $product->p_stok) {
            $cart[$p_id]['quantity']++;
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Quantity increased');
    }

    // Checkout - reduce stock
    public function checkout()
    {
        $cart = session()->get('cart');

        foreach ($cart as $p_id => $item) {
            $product = produk::find($p_id);
            if ($product) {
                // Decrease stock
                $product->p_stok -= $item['quantity'];
                $product->save();
            }
        }

        // Clear the cart
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Checkout successful and stock updated');
    }
}
