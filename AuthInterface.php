<?php

interface AuthInterface
{
    public function register(string $username, string $email, string $password): bool;
    public function login(string $email, string $password): ?array; // قمنا بتغيير التوقيع هنا
    public function logout(): void;
}
?>
