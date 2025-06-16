<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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

    public function edit($id)
    {
        return DB::table('products')->where('id', $id)->first();
    }

    public function update(ProductRequest $request, $id)
    {
        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return DB::table('products')->where('id', $id)->first();
    }

    public  function destroy($id)
    {
        return DB::table('products')->where('id', $id)->delete();
    }
}
