<?php

namespace App\Interfaces;

use App\Models\Product;

interface ProductInterface
{
    public function create(array $data): Product;
    public function update(Product $product, array $data): Product;
    public function delete(Product $product): bool;
    public function findById($id): ?Product;
    public function findAll(): \Illuminate\Database\Eloquent\Collection;
    public function findWithFilters(array $filters):  \Illuminate\Database\Eloquent\Collection;
}
