<!-- resources/views/auth/register-modal.blade.php -->
<div id="signup-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-40">
    <div class="relative bg-white w-[400px] px-8 py-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-center">Create an Account</h2>
        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" name="first_name" placeholder="First Name" class="w-full px-4 py-2 border rounded focus:ring focus:ring-green-300" required>
            </div>
            <div class="mb-3">
                <input type="text" name="last_name" placeholder="Last Name" class="w-full px-4 py-2 border rounded focus:ring focus:ring-green-300" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" placeholder="Email" class="w-full px-4 py-2 border rounded focus:ring focus:ring-green-300" required>
            </div>
            <div class="mb-3">
    <input type="tel" name="phone" placeholder="Phone Number" class="w-full px-4 py-2 border rounded focus:ring focus:ring-green-300" required>
</div>

            <div class="mb-3">
                <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 border rounded focus:ring focus:ring-green-300" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full px-4 py-2 border rounded focus:ring focus:ring-green-300" required>
            </div>
            <button type="submit" class="w-full bg-green-900 text-white py-2 rounded text-lg font-semibold hover:bg-green-700 transition">
                Create Account
            </button>
            <div class="text-center text-sm text-gray-600 mt-4">
                Already have an account? 
                <button type="button" id="toggle-login" class="text-black font-semibold hover:underline ml-1">Sign In</button>
            </div>
        </form>
    </div>
</div>