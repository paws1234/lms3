@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg">

        <div class="bg-gray-200 px-4 py-3 border-b border-gray-300 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Edit School Calendar Entry</h2>
            <a href="{{ route('school_calendars.index') }}" class="text-blue-500 hover:text-blue-600 font-medium">Back</a>
        </div>
        <div class="p-4">
            <form action="{{ route('school_calendars.update', $event->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="event_name" class="block text-sm font-medium text-gray-700">Event Name</label>
                    <input type="text" name="event_name" id="event_name" value="{{ $event->event_name }}" required
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="event_date" class="block text-sm font-medium text-gray-700">Event Date</label>
                    <input type="date" name="event_date" id="event_date" value="{{ $event->event_date }}" required
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors duration-300">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection