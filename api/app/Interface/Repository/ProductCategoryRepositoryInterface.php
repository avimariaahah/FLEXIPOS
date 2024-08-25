<?php

namespace App\Interface\Repository;

interface ProductCategoryRepositoryInterface
{
    public function findMany();

    public function findOne(int $id);

    public function create(object $payload);

    public function update(int $id, object $payload);

    public function delete(int $id);
}
