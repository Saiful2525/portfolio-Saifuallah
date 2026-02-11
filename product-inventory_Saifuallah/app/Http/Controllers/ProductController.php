<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    //Nak display semua list product
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'success'=> true,
            'data' => $products
        ], 200);
    }

    //Nak display specific product, so kita akan get by id dialah
    public function show($id)
    {

        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'success'=> false,
                'message' => 'Product not found'
            ], 404);
        }
        return response()->json([
            'success'=> true,
            'data' => $product
        ], 200);
    }

    //nak create new product, then simpan dalam database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        $product = Product::create($validated);
        return response()->json([
            'success'=> true,
            'data' => $product
        ], 201);
    }

    //nak update product by specific id
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'nullable|integer|min:0'
        ]);

        $product->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product->fresh()
        ], 200);
    }

    //nak delete product by specific id
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ], 200);
    }
}