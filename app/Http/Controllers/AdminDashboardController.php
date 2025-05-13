<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'pendingCount'   => Order::where('status', 'pending')->count(),
            'deliveredCount' => Order::where('status', 'completed')->count(),
            'pickUpCount'    => Order::where('status', 'ready for pick-up')->count(),
            'cancelledCount' => Order::where('status', 'cancelled')->count(),
            'totalOrders'    => Order::count(),
            'orders'         => Order::with('user')->latest()->take(5)->get(), // latest 5 orders
        ]);
    }
}