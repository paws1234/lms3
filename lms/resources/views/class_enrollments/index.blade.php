@extends('layouts.teacher')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-4">Class Enrollments</h1>

    <div class="px-4 py-3 flex justify-between items-center">
        <a href="{{ route('class_enrollments.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add Enrollment</a>
        <a href="{{ route('teacher.dashboard') }}" class="text-blue-500 hover:text-blue-600 font-medium">Back</a>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Class Name</th>
                <th class="border border-gray-300 px-4 py-2">Student ID</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($enrollments as $enrollment)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $enrollment->classModel->name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $enrollment->student_id }}</td>
                <td class="border border-gray-300 px-4 py-2">
                <a href="{{ route('class_enrollments.edit', [$enrollment->id]) }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2 inline-block">Edit</a>
                    <form action="{{ route('class_enrollments.destroy', $enrollment->id) }}" method="POST"
                        class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                            onclick="return confirm('Are you sure you want to delete this enrollment?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
