@extends('layouts.teacher')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-4">Quizzes</h1>

    <div class="px-4 py-3 flex justify-between items-center">
        <a href="{{ route('quizzes.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create
            Quiz</a>
        <a href="{{ route('teacher.dashboard') }}" class="text-blue-500 hover:text-blue-600 font-medium">Back</a>
    </div>

    @if ($quizzes->isEmpty())
    <p class="text-gray-600">No quizzes found.</p>
    @else
    <table class="w-full border-collapse border border-gray-300 ">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Title</th>
                <th class="border border-gray-300 px-4 py-2">Description</th>
                <th class="border border-gray-300 px-4 py-2">Class</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quizzes as $quiz)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $quiz->title }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $quiz->description }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    @if ($quiz->classModel)
                    {{ $quiz->classModel->name }}
                    @else
                    N/A
                    @endif
                </td>
                <td class="border border-gray-300 px-4 py-2 ">
                    <a href="{{ route('quizzes.edit', $quiz->id) }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2 inline-block">Edit</a>
                    <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                            onclick="return confirm('Are you sure you want to delete this quiz?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection