<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Collection;

class ProductService
{
    public function index(Request $request)
    {
        $query = Auth::user()->product()->with('type');
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->filled('type_id')) {
            $query->where('type_id', $request->input('type_id'));
        }
        $products = $query->get();
        $typeIds = $products->pluck('type_id');
        $types = ProductType::whereIn('id', $typeIds)->get();
        return [
            'products' => $products,
            'types' => $types,
        ];
    }
    public function store($request)
    {
        $newProduct = new Product();
        $newProduct->fill([
            'user_id' => Auth::id(),
            'type_id' => $request['type_id'],
            'name' => $request['name'],
            'description' => $request['description'],
        ]);
        if ($newProduct->save()) {
            return $newProduct;
        }
        return null;
    }

    public function update(ProductRequest $request, $product)
    {
        $product->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return $product;
    }

    public function destroy($product)
    {
        return $product->update([
            'deleted_at' => now()
        ]);
    }

    public function is_featured($product): void
    {
        $product->is_featured = !$product->is_featured;
        $product->save();
    }

    public function trash()
    {
        return Auth::user()->product()->onlyTrashed()->get();
    }

    public function restoreTrashed($id):void
    {
        Auth::user()->product()->onlyTrashed()->findOrFail($id)->restore();
    }

    public function forceDelete($id): void
    {
        Auth::user()->product()->onlyTrashed()->where('id', $id)->forceDelete();
    }
}
