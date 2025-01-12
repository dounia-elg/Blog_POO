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
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, idrole) VALUES (?, ?, ?, ?)");
            $idrole = 2; 
            return $stmt->execute([$username, $email, $hashedPassword, $idrole]);
        } catch (PDOException $e) {
            echo "Error during registration: " . $e->getMessage();
            return false;
        }
    }


    public function login(string $email, string $password): ?array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user; 
            } else {
                return null; 
            }
        } catch (PDOException $e) {
            echo "Login error: " . $e->getMessage();
            return null;
        }
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
