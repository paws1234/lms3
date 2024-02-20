@extends('layouts.teacher')

@section('content')
<div class="container mx-auto">
    <div class="mb-4">
        <a href="{{ route('class-materials.index') }}" class="text-blue-500 hover:text-blue-700 flex items-center">
            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Class Materials
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-4">Add New Material</h1>
        <form method="POST" action="{{ route('class-materials.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-bold mb-2">Title</label>
                <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500" id="title" name="title" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-bold mb-2">Description</label>
                <textarea class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500" id="description" name="description" rows="3"></textarea>
            </div>

            <div class="mb-4">
                <label for="class_id" class="block text-sm font-bold mb-2">Class</label>
                <select class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500" id="class_id" name="class_id" required>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="file" class="block text-sm font-bold mb-2">File</label>
                <input type="file" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500" id="file" name="file" required>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
        </form>
    </div>
</div>
@endsection
