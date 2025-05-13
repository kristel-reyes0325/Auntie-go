<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class AdminProductController extends Controller
{
    public function index()
    {
    $products = Product::with('category')->latest()->get(); // Assuming you have a category relation

    return view('admin.products', compact('products'));
    }

    public function deleteHistory()
    {
        $deletedProducts = [
            [
                'id' => 4,
                'name' => 'Resistor Notebook',
                'price' => 120,
                'supplier_price' => 80,
                'stock' => 0,
                'category' => 'Stationery',
                'deleted_at' => '2024-04-30 10:15:00',
            ],
            [
                'id' => 5,
                'name' => 'Quantum Hoodie',
                'price' => 500,
                'supplier_price' => 300,
                'stock' => 0,
                'category' => 'Clothing',
                'deleted_at' => '2024-04-28 14:30:00',
            ],
        ];

        return view('adminproducts_deletehistory', compact('deletedProducts'));
    }
}