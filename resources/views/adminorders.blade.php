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
        <nav class="p-4 space-y-2">
            <a href="#" class="flex items-center space-x-2 text-sm text-gray-700 hover:text-black">
                <span>📊</span><span>Dashboard</span>
            </a>
            <a href="#" class="flex items-center space-x-2 text-sm text-gray-700 hover:text-black">
                <span>👤</span><span>Users</span>
            </a>
            <a href="#" class="flex items-center space-x-2 text-sm text-gray-700 hover:text-black">
                <span>📦</span><span>Products</span>
            </a>
            <a href="#" class="flex items-center space-x-2 text-sm text-white bg-green-700 rounded px-2 py-1">
                <span>🔒</span><span>Orders</span>
            </a>
            <a href="#" class="flex items-center space-x-2 text-sm text-gray-700 hover:text-black">
                <span>💬</span><span>Chat</span>
            </a>
        </nav>
        <div class="absolute bottom-0 w-full p-4">
            <a href="#" class="text-blue-500 text-sm">Logout</a>
        </div>
    </aside>

    <!-- Orders Table -->
    <div class="flex-1 p-8">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-4">
                <select class="border px-2 py-1 text-sm rounded">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
                <span class="text-sm">entries per page</span>
                <div class="ml-4 text-sm">Status</div>
                <select class="border px-2 py-1 text-sm rounded">
                    <option>All</option>
                    <option>Pending</option>
                    <option>Approved</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <button class="text-gray-500 hover:text-black">📄</button>
                <button class="text-gray-500 hover:text-black">📋</button>
            </div>
        </div>

        <div class="border rounded-lg overflow-hidden bg-white">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr class="text-left">
                        <th class="px-4 py-2">Order ID</th>
                        <th class="px-4 py-2">Product</th>
                        <th class="px-4 py-2">Unit Price</th>
                        <th class="px-4 py-2">Amount</th>
                        <th class="px-4 py-2">Ref no.</th>
                        <th class="px-4 py-2">Proof of Payment</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="px-4 py-2">0021</td>
                        <td class="px-4 py-2">Sillon Fraillero</td>
                        <td class="px-4 py-2">250</td>
                        <td class="px-4 py-2">400</td>
                        <td class="px-4 py-2">00124456</td>
                        <td class="px-4 py-2 text-blue-600 underline cursor-pointer">screenshot.jpeg</td>
                        <td class="px-4 py-2">
                            <span class="text-yellow-700 bg-yellow-100 text-xs font-medium px-2 py-1 rounded-full">Pending</span>
                        </td>
                        <td class="px-4 py-2">09/29/30</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex justify-between items-center text-sm">
            <div>Showing 1 to 10 of 100 entries</div>
            <div class="flex space-x-1">
                <button class="px-2 py-1 border rounded hover:bg-gray-100">&laquo;</button>
                <button class="px-3 py-1 bg-blue-900 text-white rounded">1</button>
                <button class="px-3 py-1 border rounded hover:bg-gray-100">2</button>
                <button class="px-3 py-1 border rounded hover:bg-gray-100">3</button>
                <button class="px-3 py-1 border rounded hover:bg-gray-100">4</button>
                <button class="px-3 py-1 border rounded hover:bg-gray-100">5</button>
                <button class="px-2 py-1 border rounded hover:bg-gray-100">&gt;</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
cdn.tailwindcss.com
