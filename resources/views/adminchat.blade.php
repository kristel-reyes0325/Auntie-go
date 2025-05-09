<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Chat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white text-black flex flex-col border-r">
            <div class="text-center py-6 font-bold text-2xl border-b border-gray-300">Admin Panel</div>

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
                       {{ request()->is(ltrim($item['url'], '/')) ? 'bg-gray-200 text-black font-semibold' : 'hover:bg-gray-100 text-black' }}">
                        <span>{{ $item['icon'] }}</span>
                        <span class="text-base">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="p-4 border-t border-gray-300">
                <a href="#" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
                    <span>🚪</span><span class="text-base">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Chat Panel -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <div class="flex items-center justify-between h-16 px-6 border-b">
                <h2 class="text-xl font-semibold text-blue-900 flex items-center space-x-2">
                    <span>💬</span><span>Chat</span>
                </h2>
                <div class="text-sm text-blue-900">Business Manager</div>
            </div>

            <!-- Body -->
            <div class="flex flex-1 overflow-hidden">
                <!-- Contacts -->
                <aside class="w-64 border-r p-2">
                    <div class="mb-4">
                        <input type="text" placeholder="Search" class="w-full px-3 py-2 border rounded text-sm">
                    </div>
                    <div class="space-y-2">
                        <div class="bg-gray-100 rounded p-2">
                            <div class="font-semibold text-sm">Archie Onoya</div>
                            <div class="text-xs text-gray-500">secret</div>
                        </div>
                        <div class="bg-gray-100 rounded p-2">
                            <div class="font-semibold text-sm">Name</div>
                            <div class="text-xs text-gray-500">Lorem ipsum</div>
                        </div>
                    </div>
                </aside>

                <!-- Chat Window -->
                <main class="flex-1 flex flex-col justify-between bg-white p-4">
                    <div class="flex-1 overflow-y-auto">
                        <!-- Message from user -->
                        <div class="flex items-end space-x-2 mb-4">
                            <div class="w-4 h-4 bg-gray-200 rounded"></div>
                            <div class="bg-white text-gray-900 border rounded px-4 py-2 text-sm">When can I get my order</div>
                        </div>

                        <!-- Message from admin -->
                        <div class="flex justify-end items-end space-x-2 mb-4">
                            <div class="bg-green-600 text-white text-xs rounded px-3 py-1">secret</div>
                            <div class="w-4 h-4 bg-green-100 rounded"></div>
                        </div>
                    </div>

                    <!-- Message Input -->
                    <div class="border-t p-4">
                        <form class="flex items-center space-x-2">
                            <button type="button" class="text-gray-400 text-xl">📎</button>
                            <input type="text" placeholder="Type a message" class="flex-1 border rounded px-3 py-2 text-sm">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white p-2 rounded-full">
                                <!-- Paper plane icon (rotate 45deg for effect) -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12l14-7-7 14-2-5-5-2z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>
</html>
