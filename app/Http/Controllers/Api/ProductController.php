<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchProductRequest;
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

        return response()->json($product, Response::HTTP_OK);
    }

    // Search products
    public function searchProducts(SearchProductRequest $request)
    {

        $query = Product::query();

        // Filter by name
        if ($request->filled('name')) {
            $query->where('product_name', 'LIKE', '%' . $request->name . '%');
        }

        // Filter by presentation
        if ($request->filled('presentation')) {
            $query->where('presentation', 'LIKE', $request->presentation);
        }

        // Filter by price
        if ($request->filled('priceRange')) {
            $priceRange = explode('-', $request->input('priceRange'));
            $minPrice = $priceRange[0];
            $maxPrice = $priceRange[1];

            $query->whereBetween('price', [$minPrice, $maxPrice]);
        };

        $products = $query->get();

        return response()->json(['Products' => $products], Response::HTTP_OK);
    }
}
