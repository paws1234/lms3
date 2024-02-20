@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full lg:w-8/12">
            <div class="bg-white shadow-md rounded-lg">

                <div class="bg-gray-200 px-4 py-3 border-b border-gray-300 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Create Subject</h2>
                    <a href="{{ route('subjects.index') }}"
                        class="text-blue-500 hover:text-blue-600 font-medium">Back</a>
                </div>
                <div class="p-4">
                    <form action="{{ route('subjects.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" autocomplete="name" required
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors duration-300">Submit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection