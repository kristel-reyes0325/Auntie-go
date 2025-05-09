<!-- resources/views/auth/login-modal.blade.php -->
<div id="login-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-40">
    <div class="relative bg-white w-[400px] px-8 py-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-center">Welcome to Auntie Go</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="text-gray-700 text-sm font-medium">Enter Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded focus:ring focus:ring-green-300" required>
            </div>

            <div class="mb-3">
                <label for="password" class="text-gray-700 text-sm font-medium">Enter Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded focus:ring focus:ring-green-300" required>
            </div>

            <div class="flex items-center mb-4">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm text-gray-700">Remember Me</label>
            </div>

            <button type="submit" class="w-full bg-green-900 text-white py-2 rounded text-lg font-semibold hover:bg-green-700 transition">
                Sign In
            </button>

            <div class="flex justify-between text-sm text-gray-600 mt-3">
                <a href="{{ route('password.request') }}" class="hover:underline">Forgot Password?</a>
                <button type="button" id="toggle-signup" class="hover:underline">Create Account</button>
            </div>
        </form>

        @if ($errors->any())
    <script>
        alert('Login failed. Please check your credentials.');
    </script>
@endif
    </div>
</div>
