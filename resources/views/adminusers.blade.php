@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    @include('partials.sidebar', ['active' => 'Users'])

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-semibold text-gray-800">Users</h1>
            <div class="flex items-center space-x-2 text-sm text-gray-700">
                <svg class="w-5 h-5 text-blue-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A10.947 10.947 0 0012 20c2.386 0 4.582-.777 6.379-2.096M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.938 15.5A8.962 8.962 0 0021 12c0-4.97-4.03-9-9-9S3 7.03 3 12c0 2.01.664 3.86 1.782 5.361" />
                </svg>
                <span>Archie Onoya</span>
            </div>
        </div>

      <!-- Search -->
<div class="mb-4">
    <div class="relative" style="width: 250px;">
        <input
            type="text"
            placeholder="Search"
            class="w-full pl-3 pr-10 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
        />
        <div class="absolute inset-y-0 right-3 flex items-center">
            <svg
                class="w-4 h-4 text-gray-500"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 21l-4.35-4.35M16.65 16.65A7.5 7.5 0 1116.65 2.5a7.5 7.5 0 010 14.15z"
                />
            </svg>
        </div>
    </div>
</div>



        <!-- Users Table -->
        <div class="bg-white border shadow rounded-xl overflow-hidden">
            <table class="w-full text-sm text-gray-800">
                <thead class="text-left text-gray-600 border-b">
                    <tr>
                        <th class="py-3 px-6">Name</th>
                        <th class="py-3 px-6">Email</th>
                        <th class="py-3 px-6">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users ?? [] as $user)
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="py-3 px-6">{{ $user->name }}</td>
                            <td class="py-3 px-6">{{ $user->email }}</td>
                            <td class="py-3 px-6">
                                <span class="{{ $user->status === 'Active' ? 'text-green-600' : 'text-red-500' }}">
                                    {{ $user->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 px-6 text-center text-gray-400">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
