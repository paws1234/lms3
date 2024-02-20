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
            <h1 class="text-2xl font-bold">Student Dashboard</h1>
        </div>
        <nav class="mt-4">
            <a href="{{ route('student.classes.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">Classes</a>
            <a href="{{ route('student.announcements.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">Announcements</a>
            <a href="{{ route('student.quizzes.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">Quizzes</a>
            <a href="{{ route('student.grades.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">Grades</a>
            <a href="{{ route('student.class_materials.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">Class Materials</a>
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
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Classes</h3>
                    <a href="{{ route('student.classes.index') }}" class="text-4xl font-bold text-red-500">{{ $classCount }}</a>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Class Materials</h3>
                    <a href="{{ route('student.class_materials.index') }}" class="text-4xl font-bold text-red-500">{{ $classMaterialsCount }}</a>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Announcements</h3>
                    <a href="{{ route('student.announcements.index') }}" class="text-4xl font-bold text-red-500">{{ $announcementsCount }}</a>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Quizzes</h3>
                    <a href="{{ route('student.quizzes.index') }}" class="text-4xl font-bold text-red-500">{{ $quizzesCount }}</a>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Grades</h3>
                    <a href="{{ route('student.grades.index') }}" class="text-4xl font-bold text-red-500">{{ $gradesCount }}</a>
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
        </div>
    </main>
</div>
@endsection
