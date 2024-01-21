<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\BeerOrder;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function show($userName) {
        $user = User::where("name", $userName)->first();
        if (!$user || $userName != auth()->user()->name) {
            abort(404);
        }

        $filter = request()->query("filter");

        if (isset($filter) && $filter != "all") {
            if ($userName == "admin") {
                $orders = Order::where("state", "LIKE", "%{$filter}%")->get();
            } else {
                $userID = $user->id;
                $orders = Order::where("state", "LIKE", "%{$filter}%")->andWhere("user_id", $userID)->get();
            }
        } else {
            if ($userName == "admin") {
                $orders = Order::all();
            } else {
                $userID = $user->id;
                $orders = Order::where("user_id", $userID)->get();
            }
        }

        return view("orders.show", ["user" => $user, "orders" => $orders]);
    }

    public function form() {
        $cart = session()->get("cart", "[]");
        $cartArray = json_decode($cart, true);

        $price = 0;
        if (is_array($cartArray)) {
            foreach ($cartArray as $cartItem) {
                $price += ($cartItem["price"] * $cartItem["quantity"]);
            }
        }

        return view("orders.form", ["price" => $price]);
    }

    public function add(Request $request) {
        $cart = session()->get("cart", "[]");
        $cartArray = json_decode($cart, true);

        if (!isset($cartArray)) {
            return redirect("/")->with("message", "Košík je prázdny!");
        }

        $newOrderData = $request->validate([
            "name" => "required|max:20",
            "phoneNumber" => "required|string|min:10|max:10",
            "email" => "required",
            "address" => "required",
            "city" => "required",
            "psc" => ["required", "numeric", "digits:5"],
            "description" => "max:50"
        ]);

        $newOrder = new Order();
        $newOrder->name = $newOrderData["name"];
        $newOrder->phoneNumber = $newOrderData["phoneNumber"];
        $newOrder->email = $newOrderData["email"];
        $newOrder->address = $newOrderData["address"];
        $newOrder->city = $newOrderData["city"];
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

    public function get($user_name, $order_id) {
        $orderBeers = BeerOrder::where("order_id", $order_id)->get();
        $beers = [];
        $price = 0;
        foreach ($orderBeers as $orderBeer) {
            $beer = Beer::where("id", $orderBeer->beer_id)->first();
            $beer->quantity = $orderBeer->quantity;
            $price += $beer->price * $beer->quantity;
            $beers[] = $beer;
        }
        return view("orders.order", ["beers" => $beers, "price" => $price]);
    }

    public function cancel($order_id) {
        $order = Order::where("id", $order_id)->first();
        $order->state = 2;
        $order->save();
        return back()->with("Objednávka zrušená!");
    }

    public function delete($order_id)
    {
        $order = Order::where("id", $order_id)->first();
        if (($order->user_id == auth()->user()->getAuthIdentifier()) || auth()->user()?->name == "admin") {
            $order->delete();
            return back()->with("Objednávka vymazaná!");
        } else {
            abort(403, "Unauthorized Action");
        }
    }

    public function edit($order_id) {
        $order = Order::where("id", $order_id)->first();
        return view("orders.edit", ["order" => $order]);
    }

    public function update(Request $request, $order_id) {
        $order = Order::where("id", $order_id)->first();
        $user = auth()->user()?->name;
        if (($order->user_id == auth()->user()->getAuthIdentifier()) || $user == "admin") {
            $updatedOrder = $request->validate([
                "name" => "required|max:20",
                "phoneNumber" => "required|string|min:10|max:10",
                "email" => "required",
            ]);
            $order->update($updatedOrder);
            return redirect("/$user");
        } else {
            abort(403, "Unauthorized Action");
        }
    }
}
