@extends('layouts.app')

@section('title', 'Admin Login - SOS PET')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md border border-green-600">
            <!-- Login Card -->
            <div class="bg-white rounded-lg shadow-2xl p-8">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <img src="{{ asset('img/logo.jfif') }}" alt="Logo" class="w-16 h-16 mx-auto rounded-lg mb-4">
                    <h1 class="text-2xl font-bold text-gray-900">SOS PET Admin</h1>
                    <p class="text-gray-600 mt-2">Painel de Administração</p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
                        <ul class="text-red-700 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Success Messages -->
                @if (session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4">
                        <p class="text-green-700 text-sm">{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
                        <p class="text-red-700 text-sm">{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">
                            Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="seu@email.com"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                            required
                        >
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-2">
                            Senha
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Sua senha"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                            required
                        >
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-3 rounded-lg transition duration-200 mt-6"
                    >
                        ENTRAR
                    </button>
                </form>

                <!-- Back Link -->
                <div class="text-center mt-6">
                    <a href="{{ route('home') }}" class="text-green-600 hover:text-green-700 font-semibold text-sm">
                        ← Voltar para página inicial
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
