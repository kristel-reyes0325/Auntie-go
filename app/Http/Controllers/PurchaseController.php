<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending'); // Default tab
        $user = Auth::user();


        // Query user's orders with matching status
        $orders = Order::with('products') // eager load products
            ->where('user_id', $user->id)
            ->where('status', $status)
            ->latest()
            ->get();

        // Transform orders into display-ready array
        $items = $orders->map(function ($order) {
            return $order->products->map(function ($product) use ($order) {
                return [
                    'name' => $product->name,
                    'image' => $product->product_image,
                    'total' => $order->total_amount,
                ];
            });
        })->flatten(); // Flatten to one list of products


        return view('my-purchases', [
            'activeTab' => $status,
            'orders' => $orders,
        ]);
    }
}
