<?php

require_once 'CRUDInterface.php';

class Articles implements CRUDInterface
{
    private PDO $pdo;

    public function __construct(PDO $connection)
    {
        $this->pdo = $connection;
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO articles (title, content, image, created_at) VALUES (?, ?, ?, NOW())");
        return $stmt->execute([$data['title'], $data['content'], $data['image']]);
    }

    public function read(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM articles WHERE idarticle = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("UPDATE articles SET title = ?, content = ?, image = ? WHERE idarticle = ?");
        return $stmt->execute([$data['title'], $data['content'], $data['image'], $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM articles WHERE idarticle = ?");
        return $stmt->execute([$id]);
    }
}
