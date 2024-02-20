@extends('layouts.app')

@section('content')
<style>
    .sticky-container {
        display: flex;
        height: 100vh;
        overflow: hidden;
    }

    .sticky-sidebar {
        position: sticky;
        top: 0;
        height: 100vh;
        overflow-y: auto;
    }

    .main-content {
        flex: 1;
        overflow-y: auto;
    }
</style>

<div class="sticky-container">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white sticky-sidebar">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Admin Dashboard</h1>
            </div>
            <nav class="mt-4">
                <a href="{{ route('students.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">Students</a>
                <a href="{{ route('teachers.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">Teachers</a>
                <a href="{{ route('classes.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">Classes</a>
                <a href="{{ route('subjects.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">Subjects</a>
                <a href="{{ route('school_calendars.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">School Calendar</a>
            </nav>
            <form method="POST" action="{{ route('logout') }}" class="p-4">
                @csrf
                <button type="submit" class="w-full py-2 px-4 text-left mt-4 hover:bg-gray-700 bg-gray-600 rounded">Logout</button>
            </form>
        </aside>
 
    <!-- Main Content -->
    <main class="main-content p-8 bg-gray-100">
        <div class="container">
        <div class="grid grid-cols-2 gap-4">
            <!-- Student Counter -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Students</h3>
                <a href="{{ route('students.index') }}" class="text-4xl font-bold text-blue-500">{{ $studentCount}}</a>
            </div>
            <!-- Teacher Counter -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Teachers</h3>
                <a href="{{ route('teachers.index') }}" class="text-4xl font-bold text-green-500">{{ $teacherCount }}</a>
            </div>
            <!-- Subject Counter -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Subjects</h3>
                <a href="{{ route('teachers.index') }}" class="text-4xl font-bold text-yellow-500">{{ $subjectCount }}</a>
            </div>
            <!-- Class Counter -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Classes</h3>
                <a href="{{ route('teachers.index') }}" class="text-4xl font-bold text-red-500">{{ $classCount}}</a>
            </div>
        </div>

        <!-- School Calendar Section -->
        <div class="mt-8">
    <h2 class="text-2xl font-semibold mb-4">School Calendar</h2>
    <div class="bg-white p-4 rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-white">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Date</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-400 divide-y divide-gray-200">
                    @foreach($schoolCalendars as $event)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->event_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->event_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    </main>
</div>
@endsection
