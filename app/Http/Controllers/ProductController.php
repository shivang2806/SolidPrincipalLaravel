<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return view('products.show', compact('product'));

    }

    public function store(Request $request)
    {
        $user = auth()->user(); // Assuming the user is authenticated
        $product = $this->productService->createProduct($request->all(), $user);
        return redirect()->route('products.index');

    }

    public function update(Request $request, $id)
    {
        // Find the product by ID
        $product = $this->productService->getProductById($id);

        // Check if the product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product Not Found');
        }

        $product = $this->productService->getProductById($id);
        $updatedProduct = $this->productService->updateProduct($product, $request->all());
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        // Find the product by ID
        $product = $this->productService->getProductById($id);

        // Check if the product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product Not Found');
        }
        
        $product = $this->productService->getProductById($id);
        $this->productService->deleteProduct($product);
        return redirect()->route('products.index');

    }
}
