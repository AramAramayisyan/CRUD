<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
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

    public function index(Request $request) : object // view user Products
    {
        $data = $this->productService->index($request);

        return view('index', compact('data'));
    }

    public function create() : object // show create_Product form
    {
        $types = ProductType::all();

        return view('create', compact('types'));
    }

    public function store(ProductRequest $request) : object // store new Product
    {
        $product = $this->productService->store($request);

        return view('store', compact('product'));
    }

    public function edit(Product $product) : object // show edit form
    {
        return view('edit', compact('product'));
    }

    public function update(ProductRequest $request,  Product $product) : object // update Product
    {
        $product = $this->productService->update($request, $product);

        return view('store', compact('product'));
    }

    public function destroy(Product $product) : object // delete Product
    {
        $this->productService->destroy($product);
        $product->delete();

        return redirect()->route('products.index');
    }

    public function toggleFeature(Product $product) : object // toggle is_featured
    {
        $this->productService->is_featured($product);
        if (Auth::id() == $product->user_id) {
            return redirect('/products');
        }

        return back();
    }

    public function trash() : object // view trashed Products
    {
        $trashedProducts = $this->productService->trash();

        return view('trash', compact('trashedProducts'));
    }

    public function restore($id) : object // restore trashed Product
    {
        $this->productService->restoreTrashed($id);

        return Auth::user()->products()->onlyTrashed()->exists() ? redirect('/trash') : redirect('/products');
    }

    public function forceDelete($id) : object // force delete trashed Product
    {
        $this->productService->forceDelete($id);

        return Auth::user()->products()->onlyTrashed()->exists() ? redirect('/trash') : redirect('/products');
    }
}
