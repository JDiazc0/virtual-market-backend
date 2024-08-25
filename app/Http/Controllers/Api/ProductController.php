<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    // Get products
    public function getProducts()
    {
        $products = Product::all();

        return response()->json($products, Response::HTTP_OK);
    }

    // Get product
    public function getProduct($id)
    {
        $product = Product::with('stores')->findOrFail($id);

        return response()->json($product);
    }
}
