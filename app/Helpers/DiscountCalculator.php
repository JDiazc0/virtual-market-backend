<?php

namespace App\Helpers;

use App\Models\Promotion;
use App\Models\Product;
use App\Models\store_product;
use Carbon\Carbon;

class DiscountCalculator
{
    public static function calculateDiscounts($cartItems, $storeId)
    {
        $totalDiscount = 0;
        $subtotalAfterProductDiscounts = 0;
        $now = Carbon::now();

        foreach ($cartItems as $item) {
            $storeProduct = store_product::where('id_store', $storeId)
                ->where('id_product', $item->id_product)
                ->first();

            if (!$storeProduct) {
                continue;
            }

            $product = Product::find($item->id_product);
            if (!$product) {
                continue;
            }

            $itemPrice = $product->price * $item->amount;
            $discountedItemPrice = $itemPrice;

            // Check for product-specific promotion
            $productPromotion = Promotion::where('id_product', $item->id_product)
                ->whereHas('stores', function ($query) use ($storeId, $now) {
                    $query->where('id_store', $storeId)
                        ->where('promotion_status', 1)
                        ->where('start_date', '<=', $now)
                        ->where('end_date', '>=', $now);
                })
                ->first();

            if ($productPromotion) {
                $discountAmount = $itemPrice * ($productPromotion->percentage / 100);
                $totalDiscount += $discountAmount;
                $discountedItemPrice -= $discountAmount;
            }

            $subtotalAfterProductDiscounts += $discountedItemPrice;
        }

        // Check for store-wide promotions
        $storePromotions = Promotion::whereNull('id_product')
            ->whereHas('stores', function ($query) use ($storeId, $now) {
                $query->where('id_store', $storeId)
                    ->where('promotion_status', 1)
                    ->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
            })
            ->get();

        foreach ($storePromotions as $storePromotion) {
            $storeDiscountAmount = $subtotalAfterProductDiscounts * ($storePromotion->percentage / 100);
            $totalDiscount += $storeDiscountAmount;
            $subtotalAfterProductDiscounts -= $storeDiscountAmount;
        }

        return $totalDiscount;
    }
}
