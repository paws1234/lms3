@extends('layouts.student')

@section('content')
<div class="container mx-auto py-8">
    <div class="container mx-auto px-4 py-8 flex justify-between items-center">
        <h1 class="text-3xl font-semibold mb-6">Dashboard</h1>
        <a href="{{ route('student.dashboard') }}" class="text-blue-500 hover:text-blue-600 font-medium">Back</a>
    </div>
    
    <!-- Output quizzes -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Quizzes</h2>
        @foreach($quizzes as $quiz)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold mb-2">{{ $quiz->title }}</h3>
                <p class="text-gray-600">{{ $quiz->description }}</p>
                <!-- Add more quiz details here if needed -->
            </div>
        @endforeach
    </div>

    <!-- Output grades -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Grades</h2>
        @foreach($grades as $grade)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <!-- Display grade related information -->
                <!-- For example: -->
                <!-- <p>Quiz ID: {{ $grade->quiz_id }}</p> -->
                <!-- <p>Grade: {{ $grade->grade }}</p> -->
            </div>
        @endforeach
    </div>

    <!-- Output class materials -->
    <div>
        <h2 class="text-2xl font-semibold mb-4">Class Materials</h2>
        @foreach($classMaterials as $classMaterial)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <!-- Display class material related information -->
                <!-- For example: -->
                <!-- <p>Title: {{ $classMaterial->title }}</p> -->
                <!-- <p>Description: {{ $classMaterial->description }}</p> -->
            </div>
        @endforeach
    </div>
</div>
@endsection
