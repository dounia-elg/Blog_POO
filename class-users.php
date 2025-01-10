<?php

require_once 'AuthInterface.php';
require_once 'CRUDInterface.php';

class Users implements AuthInterface, CRUDInterface
{
    private PDO $pdo;

    public function __construct(PDO $connection)
    {
        $this->pdo = $connection;
    }

    
    public function register(string $username, string $email, string $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPassword]);
    }

    public function login(string $email, string $password): bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    public function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();
    }

   
    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$data['username'], $data['email'], password_hash($data['password'], PASSWORD_BCRYPT)]);
    }

    public function read(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE iduser = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("UPDATE users SET username = ?, email = ? WHERE iduser = ?");
        return $stmt->execute([$data['username'], $data['email'], $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE iduser = ?");
        return $stmt->execute([$id]);
    }
}
