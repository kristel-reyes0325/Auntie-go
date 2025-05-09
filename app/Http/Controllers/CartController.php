<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->id())->first();
    
            $items = $cart ? $cart->items()->with('product')->get() : collect();
    
            $total = $items->sum(function ($item) {
                return $item->product->retail_price * $item->quantity;
            });
    
            return view('addtocart', compact('items', 'total'));
        }
    
        // Fallback for guests (optional)
        $items = collect(session('cart', []));
        $total = $items->sum('price');
    
        return view('addtocart', compact('items', 'total'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
    
    // Check if the user is logged in
    if (auth()->check()) {
        // User is logged in, add to the user's cart in the database
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        
        // Check if the product is already in the cart
        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            // If item is already in the cart, update the quantity
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // If item is not in the cart, add it
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }
}   

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    public function buyNow(Request $request)
    {
        $product = Product::findOrFail($request->id);

        // Add this product to cart session
        $cart = session()->get('cart', []);

        $cart[$product->id] = [
            'id' => $product->id,
            'name' => $product->product_name,
            'price' => $product->retail_price,
            'product_image' => $product->product_image,
        ];

        session()->put('cart', $cart);

        // Redirect directly to the checkout page
        return redirect()->route('checkout')->with('buy_now_product', $product);
    }

    public function checkoutPage()
{
    // Check if user is logged in
    if (auth()->check()) {
        $cart = Cart::where('user_id', auth()->id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cartItems = $cart->items()->with('product')->get();
        return view('checkoutpage', compact('cartItems'));
    }

    return redirect()->route('login')->with('error', 'You must be logged in to checkout.');
}

}
