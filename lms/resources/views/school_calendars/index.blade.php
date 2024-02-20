@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg">
        <div class="bg-gray-200 px-4 py-3">
            <h2 class="text-xl font-semibold text-gray-800">School Calendar</h2>
        </div>


        <div class="bg-white px-4 py-3  flex justify-between items-center">
        <a href="{{ route('school_calendars.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors duration-300">Create Event</a>
                    <a href="{{ route('home') }}" class="text-blue-500 hover:text-blue-600 font-medium">Back</a>
                </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($schoolCalendars as $event)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->event_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->event_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('school_calendars.edit', $event->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ route('school_calendars.destroy', $event->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
