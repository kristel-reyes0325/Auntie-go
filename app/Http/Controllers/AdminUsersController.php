<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::all(); // Adjust this based on your data
        return view('adminusers', compact('users'));
    }
}