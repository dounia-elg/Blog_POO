<?php

require_once 'CRUDInterface.php';

class Comments implements CRUDInterface
{
    private PDO $pdo;

    public function __construct(PDO $connection)
    {
        $this->pdo = $connection;
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO comments (content, created_at, updated_at, iduser, idarticle) VALUES (?, NOW(), NOW(), ?, ?)");
        return $stmt->execute([$data['content'], $data['iduser'], $data['idarticle']]);
    }

    public function read(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE idcomment = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("UPDATE comments SET content = ?, updated_at = NOW() WHERE idcomment = ?");
        return $stmt->execute([$data['content'], $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM comments WHERE idcomment = ?");
        return $stmt->execute([$id]);
    }
}
