@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white px-4 sm:px-6 lg:px-8 py-10">
    <div class="max-w-3xl mx-auto">
        <h2 class="text-2xl font-semibold mb-10">Shopping Cart</h2>

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Cart Items --}}
        <form action="{{ route('checkout.index') }}" method="GET" id="cart-form">
            <div id="cart-items">
                @forelse ($items as $item)
                <div class="flex justify-between items-center py-4 border-b cart-item">
                    <div class="flex items-center space-x-4">
                        <!-- Item Checkbox -->
                        <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" class="item-checkbox w-4 h-4" data-price="{{ $item->product->retail_price }}">
                        <!-- Product Image -->
                        <img src="{{ asset('assets/images/' . $item->product->product_image) }}" alt="{{ $item['name'] }}" class="w-16 h-20 object-cover">
                        <!-- Product Name -->
                        <span class="text-black">{{$item->product->product_name}}</span>
                    </div>
                    <div class="text-right flex items-center space-x-4">
                        <div class="text-right">
                            <div class="text-sm font-bold">Unit Price</div>
                            <div class="font-semibold price text-black" data-price="{{ $item->product->retail_price }}">
                                Php {{ number_format($item->product->retail_price, 2) }}
                            </div>
                        </div>
                        <!-- Remove Item -->
                        <a href="{{ route('cart.remove', $item['id']) }}" class="text-xl remove-btn text-gray-600 hover:text-red-500" title="Remove item">
                            &times;
                        </a>
                    </div>
                </div>
                @empty
                <div class="text-center text-gray-500">
                    Your cart is empty.
                    <div class="mt-4">
                        <a href="{{ url('/shoppage') }}" class="inline-block border border-black text-black px-6 py-2 rounded-full hover:bg-gray-100">
                            Continue Shopping
                        </a>
                    </div>
                </div>
                @endforelse
            </div>

            {{-- Total Section --}}
            <div class="flex justify-between items-center border-t mt-8 pt-4">
                <div class="text-sm font-medium text-black">
                    Total (<span id="selected-count-bottom">0</span> Items)
                </div>
                <div class="text-right font-semibold text-black" id="subtotal">
                    Php {{ number_format($total, 2) }}
                </div>
            </div>

            {{-- Footer Controls --}}
            @if ($items->count() > 0)
            <div class="flex flex-col md:flex-row justify-between items-center mt-6 gap-4">
                <!-- Select All Checkbox -->
                <label class="inline-flex items-center text-sm text-black">
                    <input type="checkbox" id="select-all" class="mr-2 w-4 h-4">
                    Select All (<span id="selected-count">0</span>)
                </label>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <a href="{{ url('/shoppage') }}" class="px-6 py-2 text-sm rounded-full border border-gray-800 text-gray-800 hover:bg-gray-100">
                        Cancel
                    </a>
                    
                    <button type="submit" class="px-6 py-2 text-sm rounded-full border border-green-900 text-green-900 hover:bg-green-900 hover:text-white">
                        Proceed to Checkout
                    </button>
                </div>

            </div>
            @endif
        </form>
    </div>
</div>

{{-- JavaScript --}}
<script>
    // Function to format price as currency
    function formatCurrency(value) {
        return value.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' }).replace('PHP', 'Php');
    }

    // Function to update total and count based on checked items
    function updateCartSummary() {
        const checkboxes = document.querySelectorAll('.item-checkbox');
        let total = 0;
        let count = 0;

        checkboxes.forEach(cb => {
            if (cb.checked) {
                const price = parseFloat(cb.getAttribute('data-price'));
                total += price;
                count++;
            }
        });

        // Update the subtotal and item count
        document.getElementById('subtotal').innerText = count > 0 ? formatCurrency(total) : 'Php 0.00';
        document.getElementById('selected-count').innerText = count;
        document.getElementById('selected-count-bottom').innerText = count;
    }

    // Set up event listeners for checkboxes and "Select All" checkbox
    function setupEventListeners() {
        document.querySelectorAll('.item-checkbox').forEach(cb => {
            cb.addEventListener('change', updateCartSummary);
        });

        const selectAll = document.getElementById('select-all');
        if (selectAll) {
            selectAll.addEventListener('change', function () {
                document.querySelectorAll('.item-checkbox').forEach(cb => {
                    cb.checked = this.checked;
                });
                updateCartSummary();
            });
        }
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', () => {
        setupEventListeners();
        updateCartSummary();
    });
</script>

@endsection
