<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductDetailsController extends Controller
{
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('productDetails', compact('product'));
    }

    public function buyNow(Request $request)
{
    $productId = $request->input('product_id');
    $product = Product::findOrFail($productId);

    // Store the selected product temporarily in session
    session()->put('buy_now_product', $product);

    return redirect()->route('checkout.index', ['product_id' => $productId]);
}
}
