<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $product = $this->productService->store($request);
        return view('store', compact('product'));
    }

    public function edit($id)
    {
        $product = $this->productService->edit($id);
        return view('edit', compact('product'));
    }

    public function update(Request $request, $id)
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
