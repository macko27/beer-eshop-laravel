<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Cart;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class CartController extends Controller
{
    public function add(Request $request) {

        /*
        $beerID = $request->input("beerID");
        $quantity = $request->input("quantity");

        // Skontrolujte existenciu piva
        $beer = Beer::find($beerID);
        if (!$beer) {
            return response()->json(['error' => 'Pivo s daným ID neexistuje.'], 404);
        }

        // Ak je používateľ prihlásený
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->where('beerID', $beerID)->first();

            // Ak používateľ už má položku v košíku, aktualizujte množstvo
            if ($cart) {
                $cart->quantity += $quantity;
            } else {
                // Inak vytvorte nový záznam v košíku
                $cart = new Cart();
                $cart->user_id = Auth::id();
                $cart->beerID = $beerID;
                $cart->quantity = $quantity;
            }

            $cart->save();
        } else {
            // Ak používateľ nie je prihlásený
            $cartID = $request->session()->get('cart_id');
            if (!$cartID) {
                // Ak nemáme ID košíka v session, vytvorme nový
                $cartID = uniqid('cart_');
                $request->session()->put('cart_id', $cartID);
            }

            // Skontrolujte, či máme už položku v košíku
            $cart = Cart::where('cart_id', $cartID)->where('beerID', $beerID)->first();

            if ($cart) {
                // Ak používateľ už má položku v košíku, aktualizujte množstvo
                $cart->quantity += $quantity;
            } else {
                // Inak vytvorte nový záznam v košíku
                $cart = new Cart();
                $cart->cart_id = $cartID;
                $cart->beerID = $beerID;
                $cart->quantity = $quantity;
            }

            $cart->save();
        }
        */

        return response()->json(['message' => 'Položka bola úspešne pridaná do košíka.']);
    }
}
