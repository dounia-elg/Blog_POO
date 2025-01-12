<?php
require_once '../connect.php'; 
require_once '../class-users.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $users = new Users($conn);
    
    $result = $users->register($username, $email, $password);

    if ($result) {
        echo "<p class='text-center text-green-500 mt-4'>Registration successful! <a href='login.php' class='text-blue-500 underline'>Login here</a></p>";
    } else {
        echo "<p class='text-center text-red-500 mt-4'>Registration failed. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <form action="register.php" method="POST" class="bg-white p-8 rounded shadow-lg w-full max-w-sm">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Register</h2>

        <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required 
                   class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required 
                   class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required 
                   class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <button type="submit" 
                class="w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
            Register
        </button>

        <p class="mt-4 text-sm text-center text-gray-600">
            Already have an account? 
            <a href="login.php" class="text-blue-500 hover:underline">Login here</a>
        </p>
    </form>

</body>
</html>
