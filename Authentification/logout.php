<?php
require_once '../connect.php';
require_once '../class-users.php';

session_start();

$users = new Users($conn);

$users->logout();

header("Location: login.php");
exit();
?>
