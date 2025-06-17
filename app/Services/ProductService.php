<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductService
{
    public function store($request)
    {
        $newProduct = new Product();
        $newProduct->fill([
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
            'description' => $request->description,
            'is_featured' => $request->feature
        ]);
        return $product;
    }

    public function destroy($product)
    {
        return $product->delete();
    }

    public function is_featured($product)
    {
        $product->is_featured = !$product->is_featured;
        $product->save();
    }
}
