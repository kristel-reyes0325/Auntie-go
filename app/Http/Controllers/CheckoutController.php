<?php
namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // The index function will handle both "Buy Now" and "Checkout" buttons
    public function index(Request $request)
    {
        // Check if it's a Buy Now request
        $buyNowProduct = session('buy_now_product');

        if ($buyNowProduct) {
            // Handle Buy Now logic: only one product
            $cartItems = collect([
                (object)[
                    'product' => $buyNowProduct,
                ],
            ]);

            $total = $buyNowProduct->retail_price;

            return view('checkoutpage', [
                'cartItems' => $cartItems,
                'total' => $total,
                'selectedIds' => [$buyNowProduct->id],
            ]);
        }

        // Else, it's the cart checkout: fetch all cart items for the user
        $cartItems = CartItem::where('user_id', Auth::id())->get();

        // Calculate the total price of the cart items
        $total = $cartItems->sum(function ($item) {
            return $item->product->retail_price;
        });

        return view('checkoutpage', [
            'cartItems' => $cartItems,
            'total' => $total,
            'selectedIds' => $request->input('selected_items', []),  // Use selected items from the request
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_type' => 'required|in:delivery,pickup',
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'delivery_address' => 'nullable|string|max:255',
            'pickup_date' => 'nullable|date',
            'pickup_time' => 'nullable|date_format:H:i',
        ]);

        // Create a new order
        $order = new Order([
            'user_id' => Auth::id(),
            'order_type' => $validated['order_type'],
            'customer_name' => $validated['customer_name'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'delivery_address' => $validated['order_type'] === 'delivery' ? $validated['delivery_address'] : null,
            'pickup_date' => $validated['order_type'] === 'pickup' ? $validated['pickup_date'] : null,
            'pickup_time' => $validated['order_type'] === 'pickup' ? $validated['pickup_time'] : null,
        ]);

        $order->save();

        // Add selected items to the order (for both Buy Now and cart items)
        foreach ($request->input('selected_items') as $itemId) {
            $orderItem = new OrderItem([
                'order_id' => $order->id,
                'product_id' => $itemId,
            ]);
            $orderItem->save();
        }

        // Clear the session for "Buy Now" product after purchase
        session()->forget('buy_now_product');

        return redirect()->route('order.success');
    }
}
