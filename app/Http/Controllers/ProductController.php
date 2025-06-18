<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\SearchProductRequest;
use App\Models\Product;
use App\Models\ProductType;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        return $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $data = $this->productService->index($request);
        return view('index', compact('data'));
    }

    public function create()
    {
        $types = ProductType::all();
        return view('create', compact('types'));
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
            return redirect('/products');
        }
    }

    public function toggleFeature(Product $product)
    {
        $this->productService->is_featured($product);
        return redirect('/products');
    }
}
