@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12 bg-white shadow-lg rounded-lg">

    <!-- Product Details -->
    <div class="grid md:grid-cols-2 gap-8 mt-8 bg-gray-100 p-8 rounded-lg shadow-lg">
        <!-- Left Side: Description -->
        <div>
            <h3 class="text-gray-700 text-lg font-semibold">
                {{ $product->category->name ?? 'Category Unavailable' }}
            </h3>
            <h1 class="text-4xl font-bold text-gray-900 mt-2">{{ $product->product_name }}</h1>
            <p class="text-2xl font-semibold text-gray-700 mt-2">Php {{ number_format($product->retail_price, 2) }}</p>

            <p class="text-gray-600 mt-4">
                {{ $product->product_details }}
            </p>

            <!-- Optional storytelling sections -->
            @if($product->issues)
            <p class="text-gray-600 mt-4"><strong>Issues:</strong> {{ $product->issues }}</p>
            @endif

            <!-- Buttons -->
            <div class="mt-6 flex space-x-4">
                <form action="{{ route('buy.now') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="bg-green-700 text-white px-6 py-3 rounded-md shadow-md hover:bg-green-800">
                        Buy Now
                    </button>
                </form>
                <form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <button type="submit" class="border border-green-700 text-green-700 px-6 py-3 rounded-md shadow-md hover:bg-green-100">
        Add To Cart
    </button>
</form>

            </div>
        </div>

        <!-- Right Side: Image -->
        <div class="flex justify-center">
            <img src="{{ asset('assets/images/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="w-72 h-auto rounded-lg shadow-md">
        </div>
    </div>

    <!-- Product Specifications -->
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-gray-700">
            <div><span class="font-semibold">Sold as:</span> {{ $product->sold_as }}</div>
            <div><span class="font-semibold">Location:</span> {{ $product->location }}</div>
            <div><span class="font-semibold">Size:</span> {{ $product->size }}</div>
            <div><span class="font-semibold">Weight:</span> {{ $product->weight }}</div>
            <div><span class="font-semibold">Composition:</span> {{ $product->composition }}</div>
            <div><span class="font-semibold">Color:</span> {{ $product->color }}</div>
            @if($product->issues)
                <div class="md:col-span-2"><span class="font-semibold">Issues:</span> {{ $product->issues }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
