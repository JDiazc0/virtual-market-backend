<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\shopping_cart;
use App\Models\store_product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShoppingCartController extends Controller
{
    // Create shopping cart
    public function addOrUpdateShoppingCart(Request $request)
    {
        // Validate Data
        $this->validateRequest($request);

        // Verify existence of the product in the store
        $storeProduct = $this->checkProductInStore($request->id_store, $request->id_product);

        // Verify existence of the product in the cart
        $shoppingCart = $this->findShoppingCartItem($request->id_user, $request->id_store, $request->id_product);

        if ($shoppingCart) {
            // Update the quantity
            $newAmount = $shoppingCart->amount + $request->amount;
            $this->checkProductAmount($newAmount, $storeProduct->amount);
            $shoppingCart->amount = $newAmount;
            $message = 'Product quantity successfully updated in the cart';
        } else {
            // Create shopping cart
            $this->checkProductAmount($request->amount, $storeProduct->amount);
            $shoppingCart = new shopping_cart();
            $shoppingCart->id_product = $request->id_product;
            $shoppingCart->id_store = $request->id_store;
            $shoppingCart->id_user = $request->id_user;
            $shoppingCart->amount = $request->amount;
            $message = 'Product successfully added to the cart';
        }

        $shoppingCart->save();

        return response()->json(['message' => $message], Response::HTTP_CREATED);
    }

    // Delete shopping cart
    public function deleteFromShoppingCart(Request $request)
    {
        // Validar los datos
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_store' => 'required|exists:stores,id',
            'id_product' => 'required|exists:products,id',
        ]);

        // Buscar el producto en el carrito de compras
        $shoppingCartItem = $this->findShoppingCartItem($request->id_user, $request->id_store, $request->id_product);

        if ($shoppingCartItem) {
            // Eliminar el ítem si existe
            $shoppingCartItem->delete();
            return response()->json(['message' => 'Product successfully removed from the cart'], Response::HTTP_OK);
        } else {
            // Si no existe, retornar un error
            return response()->json(['error' => 'Product not found in the cart'], Response::HTTP_NOT_FOUND);
        }
    }

    // Get the entire cart of a client
    public function getCart(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_store' => 'required|exists:stores,id'
        ]);

        $shoppingCart = shopping_cart::where('id_user', $request->id_user)
            ->where('id_store', $request->id_store)
            ->get();

        return response()->json(["message" => "successfully achieved", $shoppingCart], Response::HTTP_OK);
    }


    // Private validation methods
    private function validateRequest(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_store' => 'required|exists:stores,id',
            'id_product' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:1'
        ]);
    }

    private function checkProductInStore($id_store, $id_product)
    {
        $storeProduct = store_product::where('id_product', $id_product)
            ->where('id_store', $id_store)
            ->first();

        if (!$storeProduct) {
            abort(Response::HTTP_BAD_REQUEST, 'This product does not exist in the selected store');
        }

        return $storeProduct;
    }

    private function checkProductAmount($requestedAmount, $availableAmount)
    {
        if ($requestedAmount > $availableAmount) {
            abort(Response::HTTP_BAD_REQUEST, 'The quantity ordered exceeds the quantity in the store');
        }
    }

    private function findShoppingCartItem($id_user, $id_store, $id_product)
    {
        return shopping_cart::where('id_user', $id_user)
            ->where('id_store', $id_store)
            ->where('id_product', $id_product)
            ->first();
    }
}
