<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    function list(Request $request)
    {
        return ProductResource::collection(Product::all());
    }

    function detail(string $id, Request $request)
    {
        $product = Product::where('id', $id)->firstOrFail();

        return new ProductResource($product);
    }

    function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'description' => [],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::create($request->all());
        if ($product) {
            return new ProductResource($product);
        }

        return abort(400);
    }
}