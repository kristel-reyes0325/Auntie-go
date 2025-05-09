<!-- resources/views/admin/sidebar.blade.php -->
<aside class="w-64 bg-[#2d4739] text-black flex flex-col">
    <div class="text-center py-6 font-bold text-2xl border-b border-gray-600">Admin Panel</div>

    <nav class="flex-1 p-4 space-y-2">
        @php
            $navItems = [
                ['label' => 'Dashboard', 'url' => '/admin/dashboard', 'icon' => '📊'],
                ['label' => 'Users', 'url' => '/admin/users', 'icon' => '👥'],
                ['label' => 'Products', 'url' => '/admin/products', 'icon' => '📦'],
                ['label' => 'Orders', 'url' => '/admin/orders', 'icon' => '🧾'],
                ['label' => 'Chat', 'url' => '/admin/chat', 'icon' => '💬'],
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