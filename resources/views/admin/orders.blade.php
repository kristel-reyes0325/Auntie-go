<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-60 bg-white border-r relative">
        <div class="flex items-center justify-center h-16 border-b">
            <h1 class="text-lg font-bold">Business Manager</h1>
        </div>
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
                   {{ request()->is(ltrim($item['url'], '/')) ? 'bg-[#315B50] text-white' : 'hover:bg-[#3a5e4e] text-black' }}">
                    <span>{{ $item['icon'] }}</span>
                    <span class="text-base">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>
        <div class="absolute bottom-0 w-full p-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-blue-500 text-sm">Logout</button>
            </form>
        </div>
    </aside>

    <!-- Orders Table -->
    <div class="flex-1 p-8 overflow-y-auto">
        <h2 class="text-xl font-bold mb-4">Orders</h2>

        <div class="border rounded-lg overflow-hidden bg-white">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="px-4 py-2">Order ID</th>
                        <th class="px-4 py-2">Buyer</th>
                        <th class="px-4 py-2">Product</th>
                        <th class="px-4 py-2">Unit Price</th>
                        <th class="px-4 py-2">Amount</th>
                        <th class="px-4 py-2">Ref No.</th>
                        <th class="px-4 py-2">Proof of Payment</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        @foreach ($order->items as $item)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $order->id }}</td>
                                <td class="px-4 py-2">{{ $order->user->first_name ?? 'Unknown' }}</td>
                                <td class="px-4 py-2">{{ $item->product->product_name ?? 'N/A' }}</td>
                                <td class="px-4 py-2">₱{{ number_format($item->price, 2) }}</td>
                                <td class="px-4 py-2">₱{{ number_format($order->total_price, 2) }}</td>
                                <td class="px-4 py-2">{{ $order->reference_number }}</td>
                                <td class="px-4 py-2">
                                    @if ($order->proof_of_payment)
                                        <a href="{{ asset('storage/' . $order->proof_of_payment) }}" target="_blank" class="text-blue-600 underline">
                                            View
                                        </a>
                                    @else
                                        <span class="text-gray-400">No file</span>
                                    @endif
                                </td>
                                <td class="py-2 px-2">
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded px-2 py-1">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Order Complete</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-4 py-2">{{ $order->created_at->format('m/d/Y') }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
