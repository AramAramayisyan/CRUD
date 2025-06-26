<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Mail\IsAdminMail;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function index(Request $request) : array // show all user products
    {
        $query = Auth::user()->products()->with('type');
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
    public function store($request) : ?Product // create new product
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

    public function update(ProductRequest $request, $product) : ?Product // update product
    {
        $product->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return $product;
    }

    public function destroy($product) // delete product
    {
        if (Auth::id() == $product->user_id) {
            return $product->update([
                'deleted_at' => now()
            ]);
        }
        $user = User::find($product->user_id);
        if ($user) {
            $data['name'] = $user->name;
            $data['nameFrom'] = Auth::user()->name;
            $data['productName'] = $product->name;
            Mail::to($user->email)->queue(new IsAdminMail($data));
            return Product::where('id', $product->id)->forceDelete();
        }
        return null;
    }


    public function is_featured($product) : void // toggle feature
    {
        $product->is_featured = !$product->is_featured;
        $product->save();
    }

    public function trash(): Collection // show trashed products
    {
        return Auth::user()->products()->onlyTrashed()->get();
    }

    public function restoreTrashed($id) : void // restore trashed product
    {
        Auth::user()->products()->onlyTrashed()->findOrFail($id)->restore();
    }

    public function forceDelete($id) : void // delete trashed product
    {
        Auth::user()->products()->onlyTrashed()->where('id', $id)->forceDelete();
    }
}
