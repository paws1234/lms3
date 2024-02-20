<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-3xl bg-white shadow-md rounded-md p-8">
            <h1 class="text-3xl font-semibold text-center mb-6">Welcome to our Learning Management System</h1>
            <p class="text-gray-600 text-lg mb-8">Empower your education experience with our comprehensive learning platform.</p>
            <div class="flex justify-center">
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-md mr-4">Login</a>
                <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-md">Register</a>
            </div>
        </div>
    </div>
</body>

</html>
