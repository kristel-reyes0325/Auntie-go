@extends('layouts.app')

@section('content')

<!-- Full-screen wrapper with background -->
<div class="min-vh-100 w-100 position-relative d-flex flex-column" style="padding-top: 120px;">

    <!-- Background overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" 
        style="background: url('{{ asset('images/background.png') }}') no-repeat center center fixed; background-size: cover; z-index: -2;">
    </div>
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-white" style="opacity: 0.6; z-index: -1;"></div>

    <!-- Spacing for navbar -->
    <div class="h-[100px]"></div>

    <!-- Dynamic Products Section -->
    <div class="w-full max-w-7xl px-6 py-10 mx-auto">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12">

            @foreach($products as $product)
            <a href="{{ route('productDetails.show', $product->id) }} ">
            <div class="flex flex-col items-center h-full">
                <div class="bg-white border p-4 flex-grow flex items-center justify-center">
                    <img src="{{ asset('assets/images/' .$product->product_image) }}" alt="{{ $product->product_name }}" class="object-contain h-72 w-72">
                </div>
                <div class="mt-auto text-center mb-4">
                    <p class="text-black text-sm">{{ $product->product_name }}</p>
                    <p class="text-black text-xl font-bold mt-1">Php{{ number_format($product->retail_price, 2) }}</p>
                </div>
            </div>
            </a>
            @endforeach

        </div>
    </div>

</div>

@endsection