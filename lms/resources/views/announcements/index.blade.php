@extends('layouts.teacher')

@section('content')
<div class="container">
    <h1 class="text-3xl font-bold mb-4">Announcements</h1>

    <div class="px-4 py-3 flex justify-between items-center">
        <a href="{{ route('announcements.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create New Announcement</a>
        <a href="{{ route('teacher.dashboard') }}" class="text-blue-500 hover:text-blue-600 font-medium">Back</a>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Title</th>
                <th class="border border-gray-300 px-4 py-2">Content</th>
                <th class="border border-gray-300 px-4 py-2">Class Name</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($announcements as $announcement)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $announcement->title }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $announcement->content }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $announcement->class->name }}</td> <!-- Assuming you have a 'class' relationship in your Announcement model -->
                <td class="border border-gray-300 px-4 py-2">
                    <a href="{{ route('announcements.edit', $announcement->id) }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2 inline-block">Edit</a>
                    <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST"
                        class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                            onclick="return confirm('Are you sure you want to delete this announcement?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
