<?php

namespace App\Http\Controllers\Api;

use App\Services\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['name', 'price_min', 'price_max', 'description', 'created_by']);

        $products = $this->productService->getProductsWithFilters($filters);
        return response()->json($products);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $user = auth()->user(); // Assuming the user is authenticated
        $product = $this->productService->createProduct($request->all(), $user);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        // Find the product by ID
        $product = $this->productService->getProductById($id);

        // Check if the product exists
        if (!$product) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        $product = $this->productService->getProductById($id);
        $updatedProduct = $this->productService->updateProduct($product, $request->all());
        return response()->json($updatedProduct);
    }

    public function destroy($id)
    {
        $product = $this->productService->getProductById($id);
        $this->productService->deleteProduct($product);
        return response()->json(null, 204);
    }
}
