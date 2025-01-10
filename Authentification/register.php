<?php
require_once '../classAuth.php'; 
require_once '../connect.php'; 

$message = ""; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    if (!empty($name) && !empty($email) && !empty($password)) {
        $auth = new Auth($conn);
        $message = $auth->register($name, $email, $password, $role);
    } else {
        $message = "All fields are required.";
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
<body class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('./fooorm.jpg');">
    <form method="POST" class="bg-white p-8 rounded shadow-lg w-full max-w-sm">
        <input type="hidden" name="action" value="register">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Register</h2>

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
            <input type="text" name="username" id="name" placeholder="Your name" required 
                   class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-400">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
            <input type="email" name="email" id="email" placeholder="Your email" required 
                   class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-400">
        </div>
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
            <input type="password" name="password" id="password" placeholder="Your password" required 
                   class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-400">
        </div>
        <input type="hidden" name="role" value="admin">
        <button type="submit" class="w-full px-4 py-2 font-semibold text-white bg-violet-500 rounded-lg hover:bg-violet-600 focus:outline-none focus:ring-2 focus:ring-violet-400">Register</button>
        <p class="mt-4 text-sm text-center text-gray-600">Already have an account? <a href="../Authentification/login.php" class="text-violet-500 hover:underline">Login here</a></p>
    </form>
</body>
</html>
