<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // For logging user information
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Store a new authenticated session.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user
        $request->authenticate();

        // Regenerate the session to avoid session fixation attacks
        $request->session()->regenerate();

        // Get the currently authenticated user
        $user = Auth::user();

        // Log the authenticated user (for debugging purposes)
        Log::info('Authenticated User:', ['user' => $user]);

        // Check if the user is an admin or not and redirect accordingly
        if ($user->role === 'admin') {
            // Redirect to admin dashboard if the user is an admin
            return redirect()->route('admin.dashboard');
        }

        // Redirect normal users to the shop page
        return redirect()->route('shoppage');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect the user to the home page after logging out
        return redirect('/home');
    }
}
