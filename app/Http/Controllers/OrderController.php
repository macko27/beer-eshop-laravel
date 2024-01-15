<?php

namespace App\Http\Controllers;

use App\Models\BeerOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show() {
        $cart = session()->get("cart", "[]");
        $cartArray = json_decode($cart, true);

        $price = 0;
        if (is_array($cartArray)) {
            foreach ($cartArray as $cartItem) {
                $price += ($cartItem["price"] * $cartItem["quantity"]);
            }
        }

        return view("orders.show", ["price" => $price]);
    }

    public function add() {

    }
}
