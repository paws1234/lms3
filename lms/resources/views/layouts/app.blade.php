<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>@yield('title')</title>
    <!-- Add your CSS stylesheets and JavaScript files here -->
</head>
<body>
    <header>
        <!-- Add your navigation bar here -->
        <nav>
            <ul>
        
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
    </header>

    <main>
        <!-- Content section -->
        @yield('content')
    </main>

    <footer>
        <!-- Add your footer content here -->
        <!--   <p>&copy; {{ date('Y') }} Your Company Name</p>-->
    </footer>
</body>
</html>
