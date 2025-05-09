@extends('layouts.app')

@section('content')
<style>
    body {
        background: url("{{ asset('assets/images/background.png') }}") no-repeat center center fixed;
        background-size: cover;
        font-family: 'Georgia', serif;
    }

    .checkout-section {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 1rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        padding: 2rem;
    }

    .section-box {
        border: 1px solid #ccc;
        border-radius: 0.75rem;
        padding: 1.5rem;
        background-color: white;
    }

    .btn {
        border-radius: 9999px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        font-family: 'Georgia', serif;
    }

    .btn-green {
        background-color: #4CAF50;
        color: white;
    }

    .btn-green:hover {
        background-color: #3e8e41;
    }

    .btn-cancel {
        background-color: #f5f5f5;
        color: #333;
    }

    .btn-cancel:hover {
        background-color: #ddd;
    }

    .payment-option {
        background-color: #f3f4f6;
        transition: background-color 0.3s, border-color 0.3s, color 0.3s;
        border: 2px solid transparent;
    }

    .payment-option:hover {
        background-color: #e5e7eb;
        border-color: #3e8e41;
    }

    .payment-option[data-checked="true"] {
        background-color: #4CAF50;
        border-color: #4CAF50;
        color: white;
    }

    .modal-bg {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-box {
        background-color: #f9fafb;
        border-radius: 1rem;
        padding: 2rem;
        width: 400px;
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .modal-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        background-color: white;
    }
</style>

<script src="https://unpkg.com/alpinejs" defer></script>

<div x-data="checkout()" class="container mx-auto py-12 px-6 relative">
    <!-- 🟩 Start of Form -->
    <form method="POST" action="{{ route('orders.store') }}">
        @csrf


        <div class="checkout-section">
            <!-- Header and Delivery/Pick-up -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">AUNTIE GO | Checkout</h2>
                <div class="flex items-center space-x-6">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="order_type" value="delivery" @click="changeOrderType('delivery'); openModal()" class="form-radio text-green-600">
                        <span class="text-gray-800 text-sm">For Delivery</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="order_type" value="pickup" @click="changeOrderType('pickup'); openModal()" class="form-radio text-green-600">
                        <span class="text-gray-800 text-sm">For Pick-up</span>
                    </label>
                </div>
            </div>

            <!-- Delivery/Pick-up Info -->
            <div class="section-box mb-6">
                <h3 class="text-lg font-bold mb-2" x-text="orderType === 'delivery' ? 'Delivery Address' : 'Pick-up Details'"></h3>
                <template x-if="delivery.full_name">
                    <div class="text-gray-700 space-y-1">
                        <p><strong>Name:</strong> <span x-text="delivery.full_name"></span></p>
                        <p><strong>Phone:</strong> <span x-text="delivery.phone"></span></p>
                        <template x-if="orderType === 'delivery'">
                            <p><strong>Postal Code:</strong> <span x-text="delivery.postal_code"></span></p>
                        </template>
                        <p><strong>Address:</strong> <span x-text="delivery.address"></span></p>

                        <!-- 🟨 Hidden inputs to submit delivery data -->
                        <input type="hidden" name="full_name" :value="delivery.full_name">
                        <input type="hidden" name="phone" :value="delivery.phone">
                        <input type="hidden" name="postal_code" :value="delivery.postal_code">
                        <input type="hidden" name="address" :value="delivery.address">
                    </div>
                </template>
                <template x-if="!delivery.full_name">
                    <p class="text-gray-500">No delivery or pick-up information yet.</p>
                </template>
            </div>

            <!-- Product Listing -->
            <div class="border rounded-lg p-4 mb-6">
                <div class="flex justify-between items-center border-b pb-3">
                    <div class="font-semibold text-base text-blue-900">Products Ordered</div>
                    <div class="grid grid-cols-2 gap-x-30 text-base font-semibold w-[300px]">
                        <span>Unit Price</span>
                        <span>Items Subtotal</span>
                    </div>
                </div>

                @php
                    $orderTotal = 0;
                    $shippingFee = 250;
                @endphp

                @if (isset($cartItems))
                    @foreach ($cartItems as $item)
                        @php
                            $quantity = $item->quantity ?? 1;
                            $orderTotal += $item->product->retail_price * $quantity;
                        @endphp
                        <div class="product-item flex gap-4 mt-4">
                            <img src="{{ asset('assets/images/' . $item->product->product_image) }}" width="80" height="80">
                            <div>
                                <p>{{ $item->product->product_name }}</p>
                                <p>₱{{ number_format($item->product->retail_price, 2) }}</p>
                            </div>

                            <!-- Optional: hidden inputs to pass products -->
                            <input type="hidden" name="products[]" value="{{ $item->product->id }}">
                            <input type="hidden" name="quantities[]" value="{{ $quantity }}">
                        </div>
                    @endforeach
                @elseif (isset($product))
                    @php $orderTotal = $product->retail_price; @endphp
                    <div class="product-item flex gap-4 mt-4">
                        <img src="{{ asset('assets/images/' . $product->product_image) }}" width="80" height="80">
                        <div>
                            <p>{{ $product->product_name }}</p>
                            <p>₱{{ number_format($product->retail_price, 2) }}</p>
                        </div>
                        <div class="ml-auto font-semibold">₱{{ number_format($product->retail_price, 2) }}</div>

                        <!-- Single product fallback -->
                        <input type="hidden" name="products[]" value="{{ $product->id }}">
                        <input type="hidden" name="quantities[]" value="1">
                    </div>
                @endif

                <div class="flex justify-between pt-4 text-sm">
                    <div class="text-gray-700">
                        Shipping: <strong>Standard Local</strong><br>
                        Estimated Delivery: <span id="delivery-date">3-5 days</span>
                    </div>
                    <div class="text-right font-medium text-gray-800">₱{{ number_format($shippingFee, 2) }}</div>
                </div>

                <div class="flex justify-end border-t pt-2 mt-2 text-sm font-semibold">
                    <span class="mr-2">Total:</span>
                    <span>₱{{ number_format($orderTotal + $shippingFee, 2) }}</span>
                </div>
            </div>

            <!-- Payment Options -->
            <div class="section-box mb-6">
                <h3 class="text-lg font-bold mb-4">Payment Method</h3>
                <div class="flex space-x-6">
                    <label class="payment-option flex items-center px-4 py-2 rounded-lg cursor-pointer" data-checked="false">
                        <input type="radio" name="payment_method" value="cash_on_delivery" class="hidden" onchange="updateSelection(this)">
                        <span>Cash on Delivery</span>
                    </label>
                    <label class="payment-option flex items-center px-4 py-2 rounded-lg cursor-pointer" data-checked="false">
                        <input type="radio" name="payment_method" value="g_cash" class="hidden" onchange="updateSelection(this)">
                        <span>G-Cash</span>
                    </label>
                    <label class="payment-option flex items-center px-4 py-2 rounded-lg cursor-pointer" data-checked="false">
                        <input type="radio" name="payment_method" value="cash_on_pickup" class="hidden" onchange="updateSelection(this)">
                        <span>Cash on Pick-up</span>
                    </label>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ url()->previous() }}" class="btn btn-cancel">Cancel</a>
                <button type="submit" class="btn btn-green">Place Order</button>
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="fixed inset-0 flex items-center justify-center modal-bg z-50" x-show="showModal">
        <div class="modal-box">
            <h3 class="modal-title" x-text="orderType === 'delivery' ? 'Delivery Address' : 'Pick-up Details'"></h3>
            <div class="space-y-3">
                <template x-if="orderType === 'delivery'">
                    <div>
                        <input type="text" placeholder="Full Name" x-model="tempDelivery.full_name" class="modal-input">
                        <input type="text" placeholder="Phone" x-model="tempDelivery.phone" class="modal-input">
                        <input type="text" placeholder="Postal Code" x-model="tempDelivery.postal_code" class="modal-input">
                        <input type="text" placeholder="Complete Address" x-model="tempDelivery.address" class="modal-input">
                    </div>
                </template>
                <template x-if="orderType === 'pickup'">
                    <div>
                        <input type="text" placeholder="Full Name" x-model="tempDelivery.full_name" class="modal-input">
                        <input type="text" placeholder="Phone" x-model="tempDelivery.phone" class="modal-input">
                        <input type="text" placeholder="Pick-up Location" x-model="tempDelivery.address" class="modal-input">
                    </div>
                </template>
            </div>
            <div class="flex justify-end mt-4 space-x-2">
                <button @click="closeModal" type="button" class="btn btn-cancel">Cancel</button>
                <button @click="saveDeliveryDetails" type="button" class="btn btn-green">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    function checkout() {
        return {
            orderType: '',
            showModal: false,
            delivery: {
                full_name: '',
                phone: '',
                postal_code: '',
                address: ''
            },
            tempDelivery: {
                full_name: '',
                phone: '',
                postal_code: '',
                address: ''
            },
            openModal() {
                this.tempDelivery = { ...this.delivery };
                this.showModal = true;
            },
            closeModal() {
                this.showModal = false;
            },
            saveDeliveryDetails() {
                this.delivery = { ...this.tempDelivery };
                this.closeModal();
            },
            changeOrderType(type) {
                this.orderType = type;
                // Reset details when switching
                this.delivery = { full_name: '', phone: '', postal_code: '', address: '' };
            }
        }
    }

    // Highlight selected payment option
    function updateSelection(radio) {
        document.querySelectorAll('.payment-option').forEach(el => {
            el.setAttribute('data-checked', 'false');
        });
        radio.closest('.payment-option').setAttribute('data-checked', 'true');
    }
</script>
@endsection
