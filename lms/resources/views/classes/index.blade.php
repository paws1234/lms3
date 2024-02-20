@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full lg:w-8/12">
            <div class="bg-white shadow-md rounded-lg">
                <div class="bg-gray-200 px-4 py-3 border-b border-gray-300">
                    <h2 class="text-xl font-semibold text-gray-800">Classes</h2>
                    
                </div>

                <div class="bg-white px-4 py-3 border-b border-gray-300 flex justify-between items-center">
                    <a href="{{ route('classes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors duration-300">Create Class</a>
                    <a href="{{ route('home') }}" class="text-blue-500 hover:text-blue-600 font-medium">Back</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($classes as $class)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $class->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $class->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $class->teacher->name ?? 'No Teacher' }}</td> <!-- Assuming you have a teacher relationship -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('classes.edit', $class->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                    <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this class?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
