<nav class="py-4 px-8 w-full absolute top-0 z-50" style="background-color: #2E5544;">
    <div class="flex justify-between items-center">
        <!-- Left Side Links -->
        <div class="flex space-x-12 text-white text-lg font-medium">
            <a href="#furniture" class="nav-link relative">Furniture</a>
            <a href="#paintings" class="nav-link relative">Painting</a>
            <a href="#kitchenware" class="nav-link relative">Kitchenware</a>
        </div>

             <!-- Right Side Icons -->
        <div class="flex space-x-6 text-white items-center">
            <!-- Search Icon -->
            <a href="#" class="hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14"/>
                </svg>
            </a>

            <!-- Cart Icon -->
            <a href="{{ route('cart.index') }}" class="hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49A.996.996 0 0 0 20.01 4H5.21l-.94-2H1v2h2l3.6 7.59l-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2zM6.16 6h12.15l-2.76 5H8.53zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2s-.9-2-2-2m10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2s2-.9 2-2s-.9-2-2-2"/>
                </svg>
            </a>

            <!-- User Icon -->
            <!-- User Icon with Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="hover:text-gray-300 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2M7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.5.88 4.93 1.78A7.9 7.9 0 0 1 12 20c-1.86 0-3.57-.64-4.93-1.72m11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33A7.93 7.93 0 0 1 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.5-1.64 4.83M12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6m0 5a1.5 1.5 0 0 1-1.5-1.5A1.5 1.5 0 0 1 12 8a1.5 1.5 0 0 1 1.5 1.5A1.5 1.5 0 0 1 12 11"/>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                    @auth
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                        <a href="{{ route('purchases.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">My Purchases</a>
                        <a href="{{ route('admin.chat') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Chat</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">Log out</button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Log in</a>
                    @endguest
                </div>
            </div>

        </div>
    </div>
</nav>