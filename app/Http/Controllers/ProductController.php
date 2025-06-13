<?php

namespace App\Http\Controllers;

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

    public function edit(Request $request, $id)
    {
        $validatedData = validator(['id' => $id], [
            'id' => 'required|integer|exists:products,id',
        ])->validate();

        $product = $this->productService->edit($validatedData['id']);
        return view('edit', compact('product'));
    }


    public function update(ProductRequest $request, $id)
    {
        $product = $this->productService->update($request, $id);
        return view('store', compact('product'));
    }

    public function destroy($id)
    {
        $validatedData = validator(['id' => $id], [
            'id' => 'required|integer|exists:products,id',
        ])->validate();

        if ($this->productService->destroy($validatedData['id'])) {
            return redirect('/product');
        }
    }
}
