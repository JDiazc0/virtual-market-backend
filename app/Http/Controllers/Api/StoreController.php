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

        return response()->json(['message' => 'Product Add succesfylly'], Response::HTTP_CREATED);
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

        // Create a new store promotion
        $storePromotion = new store_promotion();
        $storePromotion->id_promotion = $request->id_promotion;
        $storePromotion->id_store = $request->id_store;
        $storePromotion->start_date = $request->start_date;
        $storePromotion->end_date = $request->end_date;
        $storePromotion->promotion_status = $request->promotion_status;
        $storePromotion->save();

        return response()->json(['message' => 'Promotion Add succesfylly'], Response::HTTP_CREATED);
    }

    // Deactivate promotion
    public function deactivatePromotion(Request $request)
    {
        $request->validate([
            'id_store' => 'required|exists:stores,id',
            'id_promotion' => 'required',
        ]);

        $storePromotion = store_promotion::where('id_promotion', $request->id_promotion)
            ->where('id_store', $request->id_store)
            ->first();

        if (!$storePromotion) {
            return response()->json(['error' => 'Promotion not found or does not belong to the store'], Response::HTTP_NOT_FOUND);
        }

        $storePromotion->promotion_status = 0;
        $storePromotion->save();

        return response()->json(['message' => 'Promotion deactivated successfully'], Response::HTTP_OK);
    }

    // Activate promotion
    public function activatePromotion(Request $request)
    {
        $request->validate([
            'id_store' => 'required|exists:stores,id',
            'id_promotion' => 'required',
        ]);

        $storePromotion = store_promotion::where('id_promotion', $request->id_promotion)
            ->where('id_store', $request->id_store)
            ->first();

        if (!$storePromotion) {
            return response()->json(['error' => 'Promotion not found or does not belong to the store'], Response::HTTP_NOT_FOUND);
        }

        $storePromotion->promotion_status = 1;
        $storePromotion->save();

        return response()->json(['message' => 'Promotion activated successfully'], Response::HTTP_OK);
    }
}
