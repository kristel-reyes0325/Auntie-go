<?php

namespace App\Http\Controllers;
use App\Models\Order;


use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
public function index()
{
    $orders = Order::with(['items.product', 'user'])->latest()->get();
    return view('admin.orders', compact('orders'));
}

public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->status = $request->input('status');
    $order->save();

    return redirect()->back()->with('success', 'Order status updated successfully.');
}
}