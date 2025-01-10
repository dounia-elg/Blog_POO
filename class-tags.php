<?php

require_once 'CRUDInterface.php';

class Tags implements CRUDInterface
{
    private PDO $pdo;

    public function __construct(PDO $connection)
    {
        $this->pdo = $connection;
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO tags (name) VALUES (?)");
        return $stmt->execute([$data['name']]);
    }

    public function read(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tags WHERE idtag = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("UPDATE tags SET name = ? WHERE idtag = ?");
        return $stmt->execute([$data['name'], $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM tags WHERE idtag = ?");
        return $stmt->execute([$id]);
    }

    public function listArticlesByTag(int $idtag): array
    {
        $stmt = $this->pdo->prepare("
            SELECT a.* 
            FROM articles a
            INNER JOIN article_tags at ON a.idarticle = at.idarticle
            WHERE at.idtag = ?
        ");
        $stmt->execute([$idtag]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
}
