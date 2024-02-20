@extends('layouts.teacher')

@section('content')
<div class="container mx-auto">
    <div class="mb-4">
        <a href="{{ route('quizzes.index') }}" class="text-blue-500 hover:text-blue-700 flex items-center">
            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Quizzes
        </a>
    </div>

    <h1 class="text-3xl font-bold mb-4">Edit Quiz</h1>
    <form action="{{ route('quizzes.update', $quiz) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-sm font-bold mb-2">Title</label>
            <input type="text" name="title" id="title"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500"
                value="{{ old('title', $quiz->title) }}" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-bold mb-2">Description</label>
            <input type="text" name="description" id="description"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500"
                value="{{ old('description', $quiz->description) }}" required>
        </div>
        <div class="mb-4">
            <label for="class_id" class="block text-sm font-bold mb-2">Class</label>
            <select name="class_id" id="class_id"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500" required>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ $class->id == $quiz->class_id ? 'selected' : '' }}>{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
    </form>
</div>
@endsection
