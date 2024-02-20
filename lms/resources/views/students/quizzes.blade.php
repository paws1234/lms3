@extends('layouts.student')

@section('content')
<div class="container mx-auto py-8">
    <div class="container mx-auto px-4 py-8 flex justify-between items-center">
        <h1 class="text-3xl font-semibold mb-6">Quizzes</h1>
        <a href="{{ route('student.dashboard') }}" class="text-blue-500 hover:text-blue-600 font-medium">Back</a>
    </div>
    @foreach($quizzes as $quiz)
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-2">{{ $quiz->title }}</h2>
        <p class="text-gray-600">{{ $quiz->description }}</p>
    </div>
    @endforeach
</div>
@endsection