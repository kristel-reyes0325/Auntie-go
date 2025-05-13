@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-cover bg-center" style="background-image: url('/images/pearl-bg.jpg'); background-repeat: no-repeat;">
    <div class="max-w-[1150px] mx-auto px-8 pt-10 text-black font-sans">

        <!-- Top Navbar -->
        <div class="flex justify-between items-center text-white pb-4 border-b border-white/30">
            <div class="flex space-x-10 text-sm md:text-base">
                <a href="#" class="hover:underline">Furniture</a>
                <a href="#" class="hover:underline">Painting</a>
                <a href="#" class="hover:underline">Kitchenware</a>
            </div>
            <div class="text-white font-semibold text-lg tracking-wide">AUNTIE GO</div>
            <div class="flex space-x-6 text-lg">
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="#"><i class="fas fa-shopping-cart"></i></a>
                <a href="#"><i class="fas fa-user"></i></a>
            </div>
        </div>

        <!-- Page Title -->
        <h1 class="text-xl font-semibold mt-10 mb-6">My Purchases</h1>

        <!-- Status Tabs -->
        <div class="flex justify-between text-center text-sm font-medium border-b border-gray-400 mb-6">
            @php
                $tabs = [
                    'pending' => 'To Pay',
                    'payment recieved' => 'To ship',
                    'ready for delivery' => 'For Delivery',
                    'ready for pick-up' => 'For Pick Up',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ];
            @endphp

            @foreach ($tabs as $key => $label)
                <a href="{{ route('purchases.index', ['status' => $key]) }}"
                   class="w-1/5 py-3 transition duration-200 {{ $activeTab === $key ? 'border-b-2 border-black font-semibold text-black' : 'text-gray-500 hover:text-black' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <!-- Purchase Rows -->
@if (count($orders) > 0)
@foreach ($orders as $order)
    @foreach ($order->orderItems as $orderItem)
        <div class="mx-auto w-[85%] bg-white/70 rounded-lg px-8 py-4 mb-5 border border-black hover:bg-white/90 transition">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-5">
                    <img src="{{ asset('assets/images/'. $orderItem->product->product_image) }}"
                         alt="{{ $orderItem->product->product_name }}"
                         class="w-16 h-20 object-contain border border-gray-200 rounded">
                    <span class="text-base font-medium">{{ $orderItem->product->product_name }}</span>
                </div>
                <div class="text-base font-medium text-right">
                    <div>Total:</div>
                    <div class="font-semibold">Php {{ number_format($order->total_price, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="mb-6"></div>
    @endforeach
@endforeach
@else
    <div class="text-center text-gray-500 py-14 text-base italic border-t border-b border-gray-300">
        No orders.
    </div>
@endif


    </div>
</div>
@endsection
