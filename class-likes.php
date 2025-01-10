<?php

require_once 'CRUDInterface.php';

class Likes implements CRUDInterface
{
    private PDO $pdo;

    public function __construct(PDO $connection)
    {
        $this->pdo = $connection;
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO likes (iduser, idarticle) VALUES (?, ?)");
        return $stmt->execute([$data['iduser'], $data['idarticle']]);
    }

    public function read(int $id): array
    {
        
        $stmt = $this->pdo->prepare("SELECT * FROM likes WHERE idarticle = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM likes WHERE idlike = ?");
        return $stmt->execute([$id]);
    }

    public function countLikes(int $idarticle): int
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as count FROM likes WHERE idarticle = ?");
        $stmt->execute([$idarticle]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] ?? 0;
    }
}
