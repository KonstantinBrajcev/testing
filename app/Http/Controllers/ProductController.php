<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sku' => 'string|max:255',
            'name' => 'string|max:255',
            'price' => 'nullable|numeric|regex:/^\d{1,6}(\.\d{1,3})?$/',
        ]);
        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // $validatedData = $request->validate([
        //     'sku' => 'string|max:255',
        //     'name' => 'string|max:255',
        //     'price' => 'nullable|numeric|regex:/^\d{1,6}(\.\d{1,3})?$/',
        // ]);
        // $product->update($validatedData);
        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::findorFail($id);
        // if (!$product) {
        //     return response()->json(['message' => 'Product not found'], 404);
        // }
        $product->delete();
        return response()->json(null, 204);
    }
}
