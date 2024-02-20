@extends('layouts.teacher')

@section('content')
<div class="container mx-auto">
    <div class="mb-4">
        <a href="{{ route('class_enrollments.index') }}" class="text-blue-500 hover:text-blue-700 flex items-center">
            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Enrollments
        </a>
    </div>

    
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-3xl font-bold mb-4">Edit Class Enrollment</h1>
        <form method="POST" action="{{ route('class_enrollments.update', $enrollment->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="class_id" class="block text-sm font-medium text-gray-700">Class ID</label>
                <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="class_id" name="class_id" value="{{ $enrollment->class_id }}">
            </div>

            <div class="mb-4">
                <label for="student_id" class="block text-sm font-medium text-gray-700">Student ID</label>
                <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="student_id" name="student_id" value="{{ $enrollment->student_id }}">
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
        </form>
    </div>
</div>
@endsection
