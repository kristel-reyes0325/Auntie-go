<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('components.profile', ['user' => $user, 'mode' => 'view']);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('components.profile', ['user' => $user, 'mode' => 'edit']);
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email|unique:users,email,' . $user->id,
        'phone'      => 'nullable|string|max:20',
    ]);

    $user->first_name = $request->first_name;
    $user->last_name  = $request->last_name;
    $user->email      = $request->email;
    $user->phone      = $request->phone;
    $user->save();

    return redirect()->route('profile')->with('success', 'Profile updated successfully.');
}

}
