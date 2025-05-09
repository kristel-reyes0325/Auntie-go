@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
    @include('admin.sidebar')

    <main class="flex-1 p-6 bg-gray-50">
        <h1 class="text-2xl font-bold text-[#002F3B] mb-6">Add Product</h1>

        <form action="#" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow flex flex-col gap-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" placeholder="Input text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Product Description</label>
                        <textarea rows="4" class="mt-1 block w-full rounded border-gray-300 shadow-sm" placeholder="Enter product description..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Display Image</label>
                        <div class="mt-1 flex justify-center items-center border-2 border-dashed border-gray-300 rounded h-40">
                            <span class="text-sm text-gray-500">Drag your photo here or <a href="#" class="text-blue-500">browse from device</a></span>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <select class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                                <option>Painting</option>
                                <option>Furniture</option>
                                <option>Kitchenware</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sold As</label>
                            <input type="text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Weight</label>
                            <input type="text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Size</label>
                            <input type="text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Composition</label>
                            <input type="text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Color</label>
                            <input type="text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Issues</label>
                            <input type="text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Original Price</label>
                            <input type="text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" placeholder="₱ 1800.00" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Retail Price</label>
                            <input type="text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" placeholder="₱ 2500.00" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- FINAL BUTTON POSITION: Bottom-right -->
            <div class="flex justify-end pt-4">
                <div class="flex gap-3">
                    <button type="reset" class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded hover:text-red-600 hover:border-red-600">
                        Discard
                    </button>
                    <button type="submit" class="px-4 py-2 bg-[#2d4739] text-black text-sm rounded hover:bg-[#1e3a2e]">
                        Publish Product
                    </button>
                </div>
            </div>
        </form>
    </main>
</div>
@endsection