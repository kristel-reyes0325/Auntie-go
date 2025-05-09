@extends('layouts.app')

@section('content')
<div class="relative w-full min-h-screen flex items-center" 
    style="background-image: url('{{ asset('assets/images/') }}'); background-size: cover; background-position: center; margin-top: 0; padding-top: 0;">
    
    {{-- Hero Section --}}
    <div class="flex flex-col md:flex-row justify-between items-center w-full h-full px-16 md:px-24 py-48">
        <div class="flex flex-col items-start">
            <h1 class="text-3xl md:text-5xl font-bold text-black mb-6 md:mb-8">Timeless Treasures, <br> Vintage Pleasures.</h1>
            <button id="toggle-login" class="auth-trigger mt-4 px-8 py-3 rounded-lg border-2 border-black text-black bg-transparent transition duration-300 hover:bg-green-900 hover:text-white">
                Shop Now!
            </button>
        </div>
        <div class="mt-6 md:mt-0 flex flex-col items-center">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Auntie Go Logo" class="w-72 md:w-96">
        </div>
    </div>
</div>

{{-- Include Login and Register Modals --}}
@include('auth.login-modal')
@include('auth.register-modal')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loginButton = document.getElementById('toggle-login');
        const signupButton = document.getElementById('toggle-signup');
        const loginModal = document.getElementById('login-modal');
        const signupModal = document.getElementById('signup-modal');
        
        loginButton.addEventListener('click', function() {
            loginModal.classList.remove('hidden');
            signupModal.classList.add('hidden');
        });
        
        signupButton.addEventListener('click', function() {
            signupModal.classList.remove('hidden');
            loginModal.classList.add('hidden');
        });
    });
</script>
@endsection