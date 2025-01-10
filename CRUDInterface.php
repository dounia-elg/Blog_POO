<?php

interface CRUDInterface
{
    public function create(array $data): bool;
    public function read(int $id): array;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
