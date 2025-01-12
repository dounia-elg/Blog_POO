<?php
require_once '../connect.php';
require_once '../class-users.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userObj = new Users($conn);
    $user = $userObj->login($email, $password); 

    if ($user) {
        session_start();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['idrole'];

        if ($_SESSION['role'] == 1) { 
            header("Location: ../admin_dashboard.php");
        } else { 
            header("Location: ../index.php");
        }
        exit();
    } else {
        echo "<p class='text-red-500'>Invalid email or password.</p>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <form method="POST" action="./login.php" class="max-w-md mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Login</h2>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
            <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
            <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500" required>
        </div>
        <button type="submit" class="w-full bg-violet-500 text-white font-bold py-2 rounded-lg hover:bg-violet-600">Login</button>
    </form>

</body>
</html>
