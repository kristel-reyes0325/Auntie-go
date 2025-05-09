<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validate form input
        $request->validate([
            'order_type' => 'required|string',
            'payment_method' => 'required|string',
            'products' => 'required|array',
        ]);
    
        // Calculate total
        $total = 0;
        foreach ($request->products as $productId) {
            $product = Product::findOrFail($productId);
            $total += $product->retail_price;
        }
    
        // Add fixed shipping fee
        $shippingFee = 250;
        $total += $shippingFee;
    
        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);
        
        // Save order items
        foreach ($request->products as $productId) {
            $product = Product::findOrFail($productId);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'price' => $product->retail_price,
            ]);
        }
    
        return redirect()->route('purchases.index', ['status' => 'pending'])
                         ->with('success', 'Order placed successfully!');
    }

    public function checkout(Request $request)
{
    $selectedIds = $request->input('selected_products', []);

    $cartItems = Cart::with('product')->whereIn('id', $selectedIds)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'No products selected.');
    }

    return view('checkout', compact('cartItems'));
}

    

    public function singleProductCheckout(Request $request)
{
    $productId = $request->input('product_id');

    $product = Product::findOrFail($productId);

    // You can create a temporary "cartItem-like" structure to reuse your checkout view
    $cartItems = collect([
        (object)[
            'id' => null,
            'product' => $product,
            'quantity' => 1, // Default quantity is 1 for Buy Now
        ]
    ]);

    return view('checkout', compact('cartItems'));
}

}