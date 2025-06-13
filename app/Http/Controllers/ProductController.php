<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductIdRequest;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
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

    public function edit($id)
    {
        $product = $this->productService->edit($id);
        return view('edit', compact('product'));
    }

    public function update(ProductRequest $request, ProductIdRequest $id)
    {
        $product = $this->productService->update($request, $id);
        return view('store', compact('product'));
    }

    public function destroy($id)
    {
        if ($this->productService->destroy($id)) {
            return redirect('/product');
        }
    }
}
