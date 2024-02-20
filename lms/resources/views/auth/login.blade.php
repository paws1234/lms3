@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-900 to-indigo-600">
    <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">{{ __('Log in to your account') }}</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div class="relative">
                <label for="email" class="text-gray-700">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-input w-full mt-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="relative">
                <label for="password" class="text-gray-700">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-input w-full mt-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-indigo-600" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="ml-2 text-gray-700">{{ __('Remember Me') }}</span>
                </label>

                @if (Route::has('password.request'))
                <a class="text-indigo-600 text-sm hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>

            <button type="submit" class="w-full bg-indigo-500 text-white font-semibold py-2 px-4 rounded hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">
                {{ __('Login') }}
            </button>

            <div class="text-center text-gray-700">
                <p class="mt-4">{{ __("Don't have an account?") }}</p>
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">{{ __('Register') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
