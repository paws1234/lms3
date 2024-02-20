<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Add your CSS stylesheets and JavaScript files here -->
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
            <h1 class="text-2xl font-bold">Teacher Dashboard</h1>
        </div>
        <nav class="mt-4">
            <a href="{{ route('quizzes.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">Quizzes</a>
            <a href="{{ route('grades.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">Grades</a>
            <a href="{{ route('class-materials.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">Class Materials</a>
            <a href="{{ route('class_enrollments.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">Class Enrollments</a>
            <a href="{{ route('announcements.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-700">Announcements</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="p-4">
            @csrf
            <button type="submit" class="w-full py-2 px-4 text-left mt-4 hover:bg-gray-700 bg-gray-600 rounded">Logout</button>
        </form>
    </aside>

        
        <!-- Main Content -->
        <main class="main-content p-8 bg-gray-100">
        <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
