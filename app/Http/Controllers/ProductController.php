<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\SearchProductRequest;
use App\Models\Product;
use App\Models\ProductType;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $query = Product::with('type');
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->filled('type_id')) {
            $query->where('type_id', $request->input('type_id'));
        }
        $products = $query->get();
        $type_ids = Product::with('type')->pluck('type_id');
        $types = ProductType::whereIn('id', $type_ids)->get();
        return view('index', compact('products', 'types'));
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
