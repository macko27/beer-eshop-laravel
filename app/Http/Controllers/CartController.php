<?php

namespace App\Http\Controllers;


use App\Models\Beer;
use App\Models\Cart;
use App\Models\Review;

class CartController extends Controller
{
    public function show() {
        $cart = session()->get("cart", "[]");
        $cartArray = json_decode($cart, true);
        $cartItems = [];

        if (is_array($cartArray)) {
            foreach ($cartArray as $cartItem) {
                $beerId = $cartItem["beer_id"];
                $quantity = $cartItem["quantity"];
                $beer = Beer::find($beerId);
                if ($beer) {
                    $cartItems[] = [
                        "beer" => $beer,
                        "quantity" => $quantity,
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
            return response()->json(["message" => "Pivo nebolo nájdené!"], 404);
        }

        $cart = json_decode(session()->get("cart", "[]"), true);

        if (isset($cart[$beerID])) {
            $cart[$beerID]["quantity"] += $quantity;
        } else {
            $beer = Beer::find($beerID);

            if ($beer) {
                $cart[$beerID] = [
                    "beer_id" => $beerID,
                    "quantity" => $quantity,
                    "picture" => $beer->picture,
                    "name" => $beer->name,
                    "price" => $beer->price
                ];
            }
        }

        session()->put('cart', json_encode($cart));

        return response()->json(["message" => "Pivo bolo úspešne pridané do košíka.", "cart" => $cart]);
    }


    public function update() {
        $beerID = request()->input('beerID');
        $newQuantity = request()->input('newQuantity');

        $cart = json_decode(session()->get("cart", "[]"), true);

        if (isset($cart[$beerID])) {
            $cart[$beerID]['quantity'] = $newQuantity;
        }

        session()->put('cart', json_encode($cart));

        return response()->json(['message' => "Množstvo bolo aktualizované.", "cart" => $cart]);
    }

    public function delete() {
        $beerID = request()->input('beerID');
        $cart = json_decode(session()->get("cart", "[]"), true);

        if (isset($cart[$beerID])) {
            unset($cart[$beerID]);
            session()->put('cart', json_encode($cart));


            return response()->json(['message' => "Položka bola odstránená z košíku.", "cart" => $cart]);
        } else {
            return response()->json(['message' => "Položka nebola nájdená"]);
        }

    }
}
