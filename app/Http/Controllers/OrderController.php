<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\BeerOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function add(Request $request) {
        $cart = session()->get("cart", "[]");
        $cartArray = json_decode($cart, true);

        if (!isset($cartArray)) {
            return redirect("/")->with("message", "Košík je prázdny!");
        }

        $newOrderData = $request->validate([
            "name" => "required|max:20",
            "phoneNumber" => ["required", "numeric"],
            "email" => "required",
            "address" => "required",
            "psc" => ["required", "numeric"],
            "description" => "max:50"
        ]);

        $newOrder = new Order();
        $newOrder->name = $newOrderData["name"];
        $newOrder->phoneNumber = $newOrderData["phoneNumber"];
        $newOrder->email = $newOrderData["email"];
        $newOrder->address = $newOrderData["address"];
        $newOrder->psc = $newOrderData["psc"];
        $newOrder->description = $newOrderData["description"];
        $newOrder->state = 0;
        if (auth()->check()) {
            $newOrder->user_id = auth()->user()->getAuthIdentifier();
        }
        $newOrder->save();

        if (is_array($cartArray)) {
            foreach ($cartArray as $cartItem) {
                $beerOrder = new BeerOrder();
                $beerOrder->order_id = $newOrder->id;
                $beerOrder->beer_id = $cartItem["beer_id"];
                $beerOrder->quantity = $cartItem["quantity"];
                $beerOrder->save();
            }
        }

        session()->forget("cart");

        return redirect("/")->with("message", "Objednávka úspešne uskutočnená!");
    }
}
