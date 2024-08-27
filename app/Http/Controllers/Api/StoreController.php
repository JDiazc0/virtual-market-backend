<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\store;
use App\Models\store_product;
use App\Models\store_promotion;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    // Get stores
    public function getStores()
    {

        $stores = Store::all();

        return response()->json($stores, Response::HTTP_OK);
    }

    // Get products store
    public function getStore($id)
    {

        $stores = Store::with('products', 'promotions')->findOrFail($id);

        return response()->json($stores, Response::HTTP_OK);
    }

    // Add products to store
    public function addProducts(Request $request)
    {
        // Validate data
        $request->validate(
            [
                'id_product' => 'required',
                'id_store' => 'required',
                'amount' => 'required|numeric'
            ]
        );

        // Create a new store product
        $storeProduct = new store_product();
        $storeProduct->id_product = $request->id_product;
        $storeProduct->id_store = $request->id_store;
        $storeProduct->amount = $request->amount;
        $storeProduct->save();

        return response()->json($storeProduct, Response::HTTP_CREATED);
    }

    // Add promotions to store 
    public function addPromotions(Request $request)
    {
        // Validate data
        $request->validate(
            [
                'id_promotion' => 'required',
                'id_store' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'promotion_status' => 'required',
            ]
        );

        // Create a new store product
        $storePromotion = new store_promotion();
        $storePromotion->id_promotion = $request->id_promotion;
        $storePromotion->id_store = $request->id_store;
        $storePromotion->start_date = $request->start_date;
        $storePromotion->end_date = $request->end_date;
        $storePromotion->promotion_status = $request->promotion_status;
        $storePromotion->save();

        return response()->json($storePromotion, Response::HTTP_CREATED);
    }

    // Deactivate promotion
    public function deactivatePromotion($id)
    {
        $storePromotion = store_promotion::findOrFail($id);
        $storePromotion->promotion_status = false;
        $storePromotion->save();

        return response()->json(['message' => 'Promotion deactivated successfully'], Response::HTTP_OK);
    }

    // Activate promotion
    public function activatePromotion($id)
    {
        $storePromotion = store_promotion::findOrFail($id);
        $storePromotion->promotion_status = true;
        $storePromotion->save();

        return response()->json(['message' => 'Promotion activated successfully'], Response::HTTP_OK);
    }
}
