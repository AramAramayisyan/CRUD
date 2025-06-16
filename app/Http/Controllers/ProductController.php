<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(ProductRequest $request)
    {
        $product = $this->productService->store($request);
        return view('store', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('edit', compact('product'));
    }

    public function update(ProductRequest $request,  Product $product)
    {
        $product = $this->productService->update($request, $product);
        return view('store', compact('product'));
    }

    public function destroy(Product $product)
    {
        if ($this->productService->destroy($product)) {
            return redirect('/product');
        }
    }
}
