<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Iconify CDN for icons -->
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-dI3WesvCUX4QaWujWiBqOCMlg6KUL3+Tf8AqOHPX4S5/v50r3Bt0zDfnF6BF4FRWoOkaGuGL6L0vQ8Wy6P13Ww==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- New Navbar -->
            <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #2E5544; padding: 15px 30px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                <div class="container-fluid">
                    <!-- Toggler for small screens -->
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon" style="filter: brightness(0) invert(1);"></span>
                    </button>

                    <!-- Left-side Filter Links -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto d-flex gap-4" style="font-family: 'Alata', sans-serif;">
                            <li class="nav-item">
                                <a href="{{ route('shop.index', ['category_id' => 1]) }}" class="nav-link text-white">Furniture</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('shop.index', ['category_id' => 2]) }}" class="nav-link text-white">Painting</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('shop.index', ['category_id' => 3]) }}" class="nav-link text-white">Kitchenware</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Centered Logo -->
                    <a class="navbar-brand position-absolute start-50 translate-middle-x text-white" href="{{ url('/') }}" 
                        style="font-weight: Regular; font-size: 30px; font-family: 'Alice', serif;">
                        AUNTIE GO
                    </a>

                    <!-- Right-side Icons -->
                    <div class="d-flex align-items-center gap-3">
                        <!-- Search Icon -->
                        <a href="#" class="text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14"/>
                            </svg>
                        </a>

                        <!-- Cart Icon -->
                        <a href="#" class="text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49A.996.996 0 0 0 20.01 4H5.21l-.94-2H1v2h2l3.6 7.59l-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2zM6.16 6h12.15l-2.76 5H8.53zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2s-.9-2-2-2m10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2s2-.9 2-2s-.9-2-2-2"/>
                            </svg>
                        </a>

                        <!-- User Icon -->
                        <a href="#" class="text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2M7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.5.88 4.93 1.78A7.9 7.9 0 0 1 12 20c-1.86 0-3.57-.64-4.93-1.72m11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33A7.93 7.93 0 0 1 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.5-1.64 4.83M12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6m0 5a1.5 1.5 0 0 1-1.5-1.5A1.5 1.5 0 0 1 12 8a1.5 1.5 0 0 1 1.5 1.5A1.5 1.5 0 0 1 12 11"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content') <!-- This replaces $slot -->
            </main>
        </div>
    </body>
</html>
