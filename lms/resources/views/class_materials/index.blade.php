@extends('layouts.teacher')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-4 text-center">Class Materials</h1>

    <div class="px-4 py-3 flex justify-between items-center">
        <a href="{{ route('class-materials.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add New
            Material</a>
        <a href="{{ route('teacher.dashboard') }}" class="text-blue-500 hover:text-blue-600 font-medium">Back</a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto border-collapse border border-gray-300 w-full">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Title</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classMaterials as $classMaterial)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $classMaterial->title }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <a href="{{ route('class-materials.edit', $classMaterial->id) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2 inline-block">Edit</a>
                        <form action="{{ route('class-materials.destroy', $classMaterial->id) }}" method="POST"
                            class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                                onclick="return confirm('Are you sure you want to delete this material?')">Delete</button>
                        </form>
                        @if (Str::contains($classMaterial->file_content, ['.jpg', '.jpeg', '.png', '.gif']))
                            <a href="{{ route('class-materials.download', $classMaterial->id) }}"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Download</a>
                        @else
                            <a href="{{ route('class-materials.download', $classMaterial->id) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Download</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
