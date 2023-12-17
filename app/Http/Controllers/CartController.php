<?php

namespace App\Http\Controllers;


use App\Models\Beer;
use App\Models\Cart;

class CartController extends Controller
{
    public function show() {
        if (auth()->check()) {
            $user = auth()->user();
            $cartItems = Cart::where('user', $user->id)->get();
        } else {
            $cart = session()->get('cart', []);
            $cartItems = [];

            foreach ($cart as $cartItem) {
                $beer = Beer::find($cartItem['beer_id']);
                if ($beer) {
                    $cartItems[] = [
                        'beer' => $beer,
                        'quantity' => $cartItem['quantity'],
                    ];
                }
            }
        }
        return view("cart.show", ["cartItems" => $cartItems]);
    }

    public function add() {
        $beerID = request()->input("beerID");
        $quantity = request()->input("quantity");

        if (!$beerID) {
            return response()->json(["message" => "Pivo nebolo najdene!"], 404);
        }

        if (auth()->check()) {
            $user = auth()->user();
            $existingCartItem = Cart::where('user', $user->id)
                ->where('beer_id', $beerID)
                ->first();
            if ($existingCartItem) {
                $existingCartItem->quantity += $quantity;
                $existingCartItem->save();
            } else {
                $cartItem = new Cart();
                $cartItem->user = $user->id;
                $cartItem->beer_id = $beerID;
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$beerID])) {
                $cart[$beerID]['quantity'] += $quantity;
            } else {
                $cart[$beerID] = [
                    'beer_id' => $beerID,
                    'quantity' => $quantity,
                ];
            }

            session()->put("cart", $cart);
            return response()->json(['message' => "novy kosik"]);
        }

        return response()->json(['message' => "Položka $beerID bola úspešne pridaná do košíka v množstve $quantity."]);
    }

    public function update() {
        $beerID = request()->input('beerID');
        $newQuantity = request()->input('newQuantity');

        $cart = session()->get('cart', []);

        if (isset($cart[$beerID])) {
            $cart[$beerID]['quantity'] = $newQuantity;
        } else {
            $cart[$beerID] = [
                'beer_id' => $beerID,
                'quantity' => $newQuantity
            ];
        }

        session()->put("cart", $cart);

        return response()->json(['message' => "Množstvo bolo aktualizované."]);
    }

    public function delete() {
        $beerID = request()->input('beerID');

        if (isset($cart[$beerID])) {
            unset($cart[$beerID]);
            session()->put("cart", $cart);

            return response()->json(['message' => "Položka byla odstraněna z košíku."]);
        } else {
            return response()->json(['message' => "Položka nebola nájdená"]);
        }

    }
}
