<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
    
        // Apply category filter
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
    
        $products = $query->get();
    
        return view('shopPage', [
            'products' => $products,
            'categories' => Category::all()
        ]);
    }
    
}


