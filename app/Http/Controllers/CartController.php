<?php

namespace App\Http\Controllers;


use App\Models\Beer;
use App\Models\Cart;

class CartController extends Controller
{
    public function show() {
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
        return view("cart.show", ["cartItems" => $cartItems]);
    }

    public function add() {
        $beerID = request()->input("beerID");
        $quantity = request()->input("quantity");

        if (!$beerID) {
            return response()->json(["message" => "Pivo nebolo nájdené!"], 404);
        }

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
        return response()->json(['message' => "Pivo bolo úspešne pridané do košíka."]);
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
        $cart = session()->get('cart', []);

        if (isset($cart[$beerID])) {
            unset($cart[$beerID]);
            session()->put("cart", $cart);


            return response()->json(['message' => "Položka bola odstránená z košíku."]);
        } else {
            return response()->json(['message' => "Položka nebola nájdená"]);
        }

    }
}
