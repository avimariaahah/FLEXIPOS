<?php

namespace App\Repository;

use App\Interface\Repository\ProductCategoryRepositoryInterface;
use App\Models\ProductCategory;

class ProductCategoryRepository implements ProductCategoryRepositoryInterface
{
    public function findMany()
    {
        return ProductCategory::all();
    }
    public function findOne(int $id)
    {
        return ProductCategory::findOrFail($id);
    }

    public function create(object $payload)
    {
        $productcategory = new ProductCategory();
        $productcategory->productcategoryname = $payload->productcategoryname;
        $productcategory->isactive = $payload->isactive;
        $productcategory->save();

        return $productcategory->fresh();
    }

    public function update(object $payload, int $id)
    {
        $productcategory = ProductCategory::findOrFail($id);
        $productcategory->productcategoryname = $payload->productcategoryname;
        $productcategory->isactive = $payload->isactive;
        $productcategory->save();

        return $productcategory->fresh();
    }

    public function delete(int $id)
    {
        $productcategory = ProductCategory::findOrFail($id);

        $productcategory->delete();

        return true;
    }
}
