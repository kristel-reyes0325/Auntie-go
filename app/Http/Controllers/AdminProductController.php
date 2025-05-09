<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Circuits Shirt',
                'price' => 250,
                'stock' => 20,
                'status' => 'active',
            ],
            [
                'id' => 2,
                'name' => 'Binary Tote Bag',
                'price' => 150,
                'stock' => 10,
                'status' => 'inactive',
            ],
            [
                'id' => 3,
                'name' => 'Motherboard Mug',
                'price' => 180,
                'stock' => 25,
                'status' => 'active',
            ],
        ];

        return view('adminproducts', compact('products'));
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