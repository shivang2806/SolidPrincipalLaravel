<?php

// app/Services/ProductService.php

namespace App\Services;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createProduct(array $data, User $user): Product
    {
        // Get the authenticated user
        $user = Auth::user();

        // Attach the user_id to the data
        $data['user_id'] = $user->id;
        return $this->productRepository->create($data);
    }

    public function updateProduct(Product $product, array $data): Product
    {
        return $this->productRepository->update($product, $data);
    }

    public function deleteProduct(Product $product): bool
    {
        return $this->productRepository->delete($product);
    }

    public function getAllProducts()
    {
        return $this->productRepository->findAll();
    }

    public function getProductById($id): ?Product
    {
        return $this->productRepository->findById($id);
    }

    public function getProductsWithFilters(array $filters)
    {
        return $this->productRepository->findWithFilters($filters);
    }
}
