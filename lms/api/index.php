<?php

// Load the Laravel application
require __DIR__ . '/../bootstrap/app.php';

// Import the User model namespace outside of the function declaration
use App\Models\User;

// Set up Laravel router
$app->router->get('/api/users', function () use ($app) {
    // Retrieve all users using the User model
    $users = User::all();

    // Return the users as a JSON response
    return response()->json(['users' => $users]);
});

// Run the Laravel application
$app->run();
