<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Pass dummy data to the view (optional for now)
        return view('admindashboard', [
            'message' => 'Welcome to Admin Dashboard!'
        ]);
        
    }
}