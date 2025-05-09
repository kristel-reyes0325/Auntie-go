@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
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
    <main class="flex-1 p-6 bg-gray-50">
        <h1 class="text-2xl font-bold text-[#002F3B] mb-4">Products</h1>

        <!-- Top Bar -->
        <div class="flex flex-wrap items-center justify-between gap-2 mb-4">
            <div class="flex items-center gap-2">
                <select class="border rounded px-2 py-1 text-sm">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
                <span class="text-sm text-gray-700">entries per page</span>
            </div>

            <div class="flex items-center gap-2 flex-1 max-w-md">
                <!-- ✅ Fixed Search Field -->
                <div class="relative w-48">
                    <input type="text" placeholder="Search" class="w-full pr-9 pl-3 py-1.5 border rounded text-sm" />
                    <span class="absolute inset-y-0 right-2 flex items-center text-gray-500">
                        <iconify-icon icon="mdi:magnify"></iconify-icon>
                    </span>
                </div>

                <div class="flex items-center gap-1">
                    <label class="text-sm text-gray-700">Category</label>
                    <select class="border rounded px-2 py-1 text-sm">
                        <option>All</option>
                        <option>Furnitures</option>
                        <option>Painting</option>
                        <option>Kitchenware</option>
                    </select>
                </div>
            </div>

            <!-- ✅ Action Icons -->
            <div class="flex items-center flex-wrap gap-3 text-xl">
                <button title="Print" class="hover:text-[#0D4D14]">
                    <iconify-icon icon="mdi:printer-outline"></iconify-icon>
                </button>
                <button title="Export CSV" class="hover:text-[#0D4D14]">
                    <iconify-icon icon="mdi:file-export-outline"></iconify-icon>
                </button>
                <button title="Clear History" class="hover:text-[#0D4D14]">
                    <iconify-icon icon="mdi:history"></iconify-icon>
                </button>
                <button title="Delete" class="hover:text-red-600">
                    <iconify-icon icon="mdi:trash-can-outline"></iconify-icon>
                </button>

                <button class="flex items-center gap-1 border px-3 py-1 rounded text-sm bg-white hover:bg-gray-100">
                    <span>Add Product</span>
                    <iconify-icon icon="mdi:plus"></iconify-icon>
                </button>
            </div>
        </div>

      <!-- ✅ Product Table - responsive & full width -->
<div class="bg-white rounded-lg overflow-x-auto border">
    <table class="w-full text-sm text-left table-auto">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Thumbnail</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-t">
                <td class="px-4 py-2">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" class="form-checkbox text-green-600" />
                        <span>00121</span>
                    </div>
                </td>
                <td class="px-4 py-2">
                    <div class="w-6 h-6 bg-gray-300 rounded"></div>
                </td>
                <td class="px-4 py-2">Victorian Chair</td>
                <td class="px-4 py-2">₱ 250.00</td>
                <td class="px-4 py-2">Furniture</td>
                <td class="px-4 py-2 text-right">
                    <iconify-icon icon="mdi:dots-horizontal"></iconify-icon>
                </td>
            </tr>
        </tbody>
    </table>
</div>


        <!-- Pagination -->
        <div class="flex items-center justify-between mt-4 text-sm text-gray-700">
            <div>Showing 1 to 10 of 100 entries</div>
            <div class="flex items-center gap-1">
                <button class="px-2 py-1 border rounded hover:bg-gray-100">&laquo;</button>
                <button class="px-2 py-1 border rounded hover:bg-gray-100">&lt;</button>
                <button class="px-2 py-1 border bg-[#002F3B] text-white rounded">1</button>
                <button class="px-2 py-1 border rounded hover:bg-gray-100">2</button>
                <button class="px-2 py-1 border rounded hover:bg-gray-100">3</button>
                <button class="px-2 py-1 border rounded hover:bg-gray-100">4</button>
                <button class="px-2 py-1 border rounded hover:bg-gray-100">5</button>
                <button class="px-2 py-1 border rounded hover:bg-gray-100">&gt;</button>
                <button class="px-2 py-1 border rounded hover:bg-gray-100">&raquo;</button>
            </div>
        </div>
    </main>
</div>

<!-- ✅ Iconify JS CDN -->
<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
@endsection
code.iconify.design
