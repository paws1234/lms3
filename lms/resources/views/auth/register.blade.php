@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-900 to-indigo-600">
    <div class="max-w-md w-full p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">{{ __('Register') }}</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div class="relative">
                <label for="name" class="text-gray-700">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-input w-full mt-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                <span class="text-red-500 text-sm absolute bottom-0 mb-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="relative">
                <label for="email" class="text-gray-700">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-input w-full mt-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <span class="text-red-500 text-sm absolute bottom-0 mb-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="relative">
                <label for="password" class="text-gray-700">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-input w-full mt-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <span class="text-red-500 text-sm absolute bottom-0 mb-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="relative">
                <label for="password-confirm" class="text-gray-700">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-input w-full mt-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="password_confirmation" required autocomplete="new-password">
            </div>

            <button type="submit" class="w-full bg-indigo-500 text-white font-semibold py-2 px-4 rounded hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">
                {{ __('Register') }}
            </button>

            <div class="text-center text-gray-700">
                <p class="mt-4">{{ __("Already have an account?") }}</p>
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">{{ __('Login') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
