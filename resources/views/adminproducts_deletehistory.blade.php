@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-[#f5f7fa] text-[#1A1A1A]">
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
    <div class="flex-1 p-8 bg-white shadow-inner">
        <h1 class="text-xl font-bold text-[#002f3b] mb-6">Product Delete History</h1>

        @php
        $deletedProducts = [
            [
                'id' => '00121',
                'name' => 'Circuit T-Shirt',
                'price' => 250,
                'supplier_price' => 250,
                'stock' => 20,
                'category' => 'T-Shirt',
                'deleted_at' => '2024-09-25',
                'thumbnail' => 'https://via.placeholder.com/50'
            ]
        ];
        @endphp

        <!-- Top Controls -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-4">
                <!-- Entries per page -->
                <div class="flex items-center space-x-2">
                    <select id="entries" name="entries" class="border border-gray-300 rounded px-2 py-1 text-sm w-auto focus:outline-none focus:ring-2 focus:ring-[#2d4739]">
                        <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('entries') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span class="text-sm">entries per page</span>
                </div>

                <!-- Search field beside entries -->
                <div>
                    <input type="text" placeholder="Search" class="border rounded px-3 py-1 text-sm" />
                </div>
            </div>

            <!-- Print, CSV Download, and Restore All buttons on the right -->
            <div class="flex items-center space-x-2">
               <!-- Print Icon Button -->
<button onclick="window.print()" class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300" title="Print">
    <i class="fas fa-print"></i>
</button>

<!-- CSV Download Icon Button -->
<form action="{{ route('download.csv') }}" method="POST">
    @csrf
    <button type="submit" class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300" title="Download CSV">
        <i class="fas fa-file-csv"></i>
    </button>
</form>

                <!-- Restore Product Button -->
                <button class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300 flex items-center space-x-2" title="Restore Product">
                    <i class="fas fa-undo"></i><span>Restore Product</span>
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto border rounded-lg shadow-sm">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2"><input type="checkbox" /></th>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Thumbnail</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Supplier Price</th>
                        <th class="px-4 py-2">Available Stocks</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Deletion Date</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deletedProducts as $product)
                        <tr class="border-t">
                            <td class="px-4 py-2"><input type="checkbox" /></td>
                            <td class="px-4 py-2">{{ $product['id'] }}</td>
                            <td class="px-4 py-2">
                                <img src="{{ $product['thumbnail'] }}" alt="thumb" class="w-6 h-6 rounded" />
                            </td>
                            <td class="px-4 py-2 truncate max-w-[100px]">{{ $product['name'] }}</td>
                            <td class="px-4 py-2">₱ {{ number_format($product['price'], 2) }}</td>
                            <td class="px-4 py-2">₱ {{ number_format($product['supplier_price'], 2) }}</td>
                            <td class="px-4 py-2">{{ $product['stock'] }}</td>
                            <td class="px-4 py-2">{{ $product['category'] }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($product['deleted_at'])->format('m/d/Y') }}</td>
                            <td class="px-4 py-2">
                                <button class="flex items-center space-x-1 text-green-600 hover:text-green-800 text-sm px-2 py-1 border border-green-600 rounded" title="Restore Product">
                                    <i class="fas fa-undo-alt"></i>
                                    <span>Restore</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex justify-between text-sm">
            <span>Showing 1 to 10 of 100 entries</span>
            <div class="space-x-1">
                <button class="px-2 py-1 bg-gray-100 rounded">&laquo;</button>
                <button class="px-2 py-1 bg-gray-100 rounded">&lsaquo;</button>
                <button class="px-2 py-1 bg-blue-500 text-white rounded">1</button>
                <button class="px-2 py-1 bg-gray-100 rounded">2</button>
                <button class="px-2 py-1 bg-gray-100 rounded">3</button>
                <button class="px-2 py-1 bg-gray-100 rounded">&rsaquo;</button>
                <button class="px-2 py-1 bg-gray-100 rounded">&raquo;</button>
            </div>
        </div>
    </div>
</div>
@endsection
