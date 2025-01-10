<?php

interface AuthInterface
{
    public function register(string $username, string $email, string $password): bool;
    public function login(string $email, string $password): bool;
    public function logout(): void;
}
