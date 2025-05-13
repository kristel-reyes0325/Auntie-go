@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="flex h-full">
    <!-- Sidebar -->
    <aside class="w-64 bg-[#2d4739] text-black flex flex-col">
        <div class="text-center py-6 font-bold text-2xl border-b border-gray-600">Admin Panel</div>
        <nav class="flex-1 p-4 space-y-2">
            @php
                $navItems = [
                    ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => '📊', 'url' => '/admin/dashboard'],
                    ['label' => 'Users', 'route' => 'admin.users', 'icon' => '👥', 'url' => '/admin/users'],
                    ['label' => 'Products', 'route' => 'admin.products', 'icon' => '📦', 'url' => '/admin/products'],
                    ['label' => 'Orders', 'route' => 'admin.orders', 'icon' => '🧾', 'url' => '/admin/orders'],
                    ['label' => 'Chat', 'route' => 'admin.chat', 'icon' => '💬', 'url' => '/admin/chat'],
                ];
            @endphp

            @foreach ($navItems as $item)
                <a href="{{ $item['url'] }}"
                   class="flex items-center space-x-3 px-4 py-2 rounded 
                   {{ request()->is(ltrim($item['url'], '/')) ? 'bg-[#315B50] text-black' : 'hover:bg-[#3a5e4e] text-black' }}">
                    <span>{{ $item['icon'] }}</span>
                    <span class="text-base">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="p-4 border-t border-gray-600">
            <a href="#" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#3a5e4e] rounded">
                <span>🚪</span><span class="text-base">Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-auto">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Sales Analytics</h1>

        <!-- Analytics Cards -->
        @php
            $analytics = [
                'Pending' => $pendingCount,
                'Delivered' => $deliveredCount,
                'Pick Up' => $pickUpCount,
                'Cancelled' => $cancelledCount,
                'Total Orders' => $totalOrders,
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-10">
            @foreach($analytics as $label => $count)
                <div class="bg-white p-5 rounded-lg shadow text-center">
                    <p class="{{ in_array($label, ['Pending', 'Delivered', 'Total Orders']) ? 'text-yellow-600' : 'text-gray-700' }} font-semibold text-sm uppercase tracking-wide">
                        {{ $label }}
                    </p>
                    <p class="text-2xl font-bold mt-2">{{ $count }}</p>
                </div>
            @endforeach
        </div>

        <!-- Recent Orders -->
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-yellow-600">Recent Orders</h2>
                <a href="#" class="text-sm text-blue-500 hover:underline">See All</a>
            </div>

            <table class="w-full table-auto text-left text-sm">
                <thead>
                    <tr class="border-b text-gray-600">
                        <th class="py-2 px-2">Order No.</th>
                        <th class="py-2 px-2">Name</th>
                        <th class="py-2 px-2">Item(s)</th>
                        <th class="py-2 px-2">Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-2">{{ $order->id }}</td>
                            <td class="py-2 px-2">{{ $order->user->full_name ?? 'N/A' }}</td>
                            <td class="py-2 px-2">1</td>
                            <td class="py-2 px-2">₱{{ number_format($order->total_price, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-400">No orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
