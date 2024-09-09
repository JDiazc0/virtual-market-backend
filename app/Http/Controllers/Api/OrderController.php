<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\shopping_cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\DiscountCalculator;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\GetOrdersRequest;
use App\Models\order;
use App\Models\ordered_item;

class OrderController extends Controller
{
    // Create Order
    public function createOrder(CreateOrderRequest $request)
    {

        try {
            DB::beginTransaction();

            // Get all cart products
            $cartItems = shopping_cart::where('id_user', $request->id_user)
                ->where('id_store', $request->id_store)
                ->with('product')
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['error' => 'Cart is empty'], Response::HTTP_BAD_REQUEST);
            }

            // Total cost of products
            $productValue = $cartItems->sum(function ($item) {
                return $item->amount * $item->product->price;
            });

            // Product discounts + store discounts
            $discountValue = DiscountCalculator::calculateDiscounts($cartItems, $request->id_store);

            // Shipping cost
            $shippingValue = 500;

            // Tax cost
            $taxValue = $productValue * .19;

            // Final cost
            $finalValue = $productValue + $shippingValue - $discountValue;

            // Create order
            $order = order::create([
                'id_store' => $request->id_store,
                'id_user' => $request->id_user,
                'instructions' => $request->instructions,
                'delivery_date' => $request->delivery_date,
                'product_value' => $productValue,
                'shipping_value' => $shippingValue,
                'discount_value' => $discountValue,
                'taxes_value' => $taxValue,
                'final_value' => $finalValue,
                'address' => $request->address,
                'rate' => $request->rate,
                'id_status' => 1,
            ]);

            // Create ordered items
            foreach ($cartItems as $cartItem) {
                $result = DiscountCalculator::calculateDiscountedPrice($cartItem->product, $request->id_store);

                // Datos para el `ordered_item`
                $unitValue = $cartItem->product->price;
                $discountedUnitValue = $result['price'];
                $finalValue = $discountedUnitValue * $cartItem->amount;
                $discountValue += ($unitValue - $discountedUnitValue) * $cartItem->amount;
                $listPrice = $unitValue * $cartItem->amount;

                // Crear `ordered_item`
                ordered_item::create([
                    'id_product' => $cartItem->id_product,
                    'id_order' => $order->id,
                    'id_promotion' => $result['promotion_id'],
                    'amount' => $cartItem->amount,
                    'unit_value' => $unitValue,
                    'discounted_unit_value' => $discountedUnitValue,
                    'list_price' => $listPrice,
                    'final_value' => $finalValue,
                ]);
            }

            // Clear the cart
            shopping_cart::where('id_user', $request->id_user)
                ->where('id_store', $request->id_store)
                ->delete();

            DB::commit();

            return response()->json(['order' => $order], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error creating the order' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Get orders from a customer in a store
    public function getOrders(GetOrdersRequest $request)
    {

        $query = order::where('id_store', $request->id_store)
            ->where('id_user', $request->id_user);

        if ($request->has('id_status') && $request->id_status !== null) {
            $query->where('id_status', $request->id_status);
        }

        $orders = $query->with('orderedItems')->get();

        return response()->json(['orders' => $orders], Response::HTTP_OK);
    }
}
