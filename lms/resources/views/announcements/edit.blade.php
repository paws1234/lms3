@extends('layouts.teacher')

@section('content')
<div class="container mx-auto">
    <div class="mb-4">
        <a href="{{ route('announcements.index') }}" class="text-blue-500 hover:text-blue-700 flex items-center">
            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Announcements
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-4">Edit Announcement</h1>
        <form method="POST" action="{{ route('announcements.update', $announcement->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
                <input id="title" type="text" class="mt-1 form-input block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('title') border-red-500 @enderror" name="title" value="{{ $announcement->title }}" required autofocus>
                @error('title')
                <span class="text-red-500 text-sm mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">{{ __('Content') }}</label>
                <textarea id="content" class="mt-1 form-textarea block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('content') border-red-500 @enderror" name="content" required>{{ $announcement->content }}</textarea>
                @error('content')
                <span class="text-red-500 text-sm mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <!-- Add input field for class_id -->
            <div class="mb-4">
                <label for="class_id" class="block text-sm font-medium text-gray-700">{{ __('Class ID') }}</label>
                <input id="class_id" type="number" class="mt-1 form-input block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('class_id') border-red-500 @enderror" name="class_id" value="{{ $announcement->class_id }}" required>
                @error('class_id')
                <span class="text-red-500 text-sm mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <!-- End input field for class_id -->
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Update Announcement') }}</button>
        </form>
    </div>
</div>
@endsection
