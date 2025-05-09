<aside class="w-64 bg-[#f6f8fa] h-screen shadow text-black flex flex-col">
    <div class="text-2xl font-bold text-[#E0A800] px-6 py-4">
        Siyen<span class="text-blue-900">Shop</span>
    </div>
    <nav class="flex-1 px-4 space-y-1 mt-2">
        @php
            $nav = ['Dashboard', 'Users', 'Products', 'Orders', 'Chat'];
            $icons = ['📊', '👥', '📦', '🧾', '💬'];
        @endphp

        @foreach($nav as $i => $item)
            <a href="{{ url('/admin/' . strtolower($item)) }}"
               class="flex items-center space-x-3 px-4 py-2 rounded {{ $active == $item ? 'bg-[#315B50] text-white' : 'hover:bg-[#3a5e4e] text-black' }}">
                <span>{{ $icons[$i] }}</span>
                <span class="text-base">{{ $item }}</span>
            </a>
        @endforeach
    </nav>

    <div class="mt-auto p-4">
        <a href="#" class="flex items-center space-x-3 px-4 py-2 text-[#315B50] hover:bg-gray-100 rounded">
            <span>🚪</span><span class="text-base">Logout</span>
        </a>
    </div>
</aside>