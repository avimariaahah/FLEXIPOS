<?php

namespace App\Interface\Service;

interface ProductCategoryServiceInterface
{
    public function findProductCategories();

    public function findProductCategoryById(int $id);

    public function createProductCategory(object $payload);

    public function updateProductCategory(int $id, object $payload);

    public function removeProductCategory(int $id);
}
