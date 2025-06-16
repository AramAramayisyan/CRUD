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
            'name' => $request['name'],
            'description' => $request['description'],
        ]);
        if ($newProduct->save()) {
            return $newProduct;
        }
    }

    public function update(ProductRequest $request, $product)
    {
        $product->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return $product;
    }

    public  function destroy($product)
    {
        return $product->delete();
    }
}
