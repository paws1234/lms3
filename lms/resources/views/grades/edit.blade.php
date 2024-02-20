@extends('layouts.teacher')

@section('content')
<div class="container mx-auto">
    <div class="mb-4">
        <a href="{{ route('grades.index') }}" class="text-blue-500 hover:text-blue-700 flex items-center">
            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Grades
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-4">Edit Grade</h1>
        <form method="POST" action="{{ route('grades.update', $grade->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="score" class="block text-sm font-medium text-gray-700">{{ __('Score') }}</label>
                <input type="number" class="mt-1 form-input block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('score') border-red-500 @enderror" id="score" name="score" value="{{ $grade->score }}" required>
                @error('score')
                <span class="text-red-500 text-sm mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="student_id" class="block text-sm font-medium text-gray-700">{{ __('Student') }}</label>
                <select class="mt-1 form-select block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('student_id') border-red-500 @enderror" id="student_id" name="student_id" required>
                    @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $grade->student_id ? 'selected' : '' }}>{{ $student->name }}</option>
                    @endforeach
                </select>
                @error('student_id')
                <span class="text-red-500 text-sm mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="quiz_id" class="block text-sm font-medium text-gray-700">{{ __('Quiz') }}</label>
                <select class="mt-1 form-select block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('quiz_id') border-red-500 @enderror" id="quiz_id" name="quiz_id" required>
                    @foreach($quizzes as $quiz)
                    <option value="{{ $quiz->id }}" {{ $quiz->id == $grade->quiz_id ? 'selected' : '' }}>{{ $quiz->title }}</option>
                    @endforeach
                </select>
                @error('quiz_id')
                <span class="text-red-500 text-sm mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Update') }}</button>
        </form>
    </div>
</div>
@endsection
