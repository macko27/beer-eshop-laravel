<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\BeerOrder;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login() {
        return view("users.login");
    }

    public function authenticate(Request $request) {
        $user = $request->validate([
            "email" => ["required", "email"],
            "password" => "required"
        ]);

        if (auth()->attempt($user)) {
            $request->session()->regenerate();

            return redirect("/")->with("message" , "Si prihlásený");
        }
        return back()->withErrors(["email" => "Nesprávne údaje"])->onlyInput("email");
    }

    public function register() {
        return view("users.register");
    }

    public function registerNewUser(Request $request) {
        $userRequest = $request->validate([
            "name" => ["required", Rule::unique("users", "name")],
            "email" => ["required", "email", Rule::unique("users", "email")],
            "password" => "required|confirmed|min:8"
        ]);

        $userRequest["password"] = bcrypt($userRequest["password"]);
        $newUser = User::create($userRequest);
        auth()->login($newUser);

        return redirect("/")->with("message", "Uspesne prihlasenie");
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/");
    }

    public function show($userName) {
        $user = User::where("name", $userName)->first();
        if (!$user || $userName != auth()->user()->name) {
            abort(404);
        }

        $allOrders = [];
        if ($user != null) {
            $userID = $user->id;
            $orders = Order::where("user_id", $userID)->get();

            foreach ($orders as $order) {
                $orderID = $order->id;
                $orderBeers = BeerOrder::where("order_id", $orderID)->get();
                $beers = [];
                $price = 0;
                foreach ($orderBeers as $orderBeer) {
                    $beer = Beer::where("id", $orderBeer->beer_id)->get();
                    $beer->quantity = $orderBeer->quantity;
                    $price += $beer["price"] * $beer->quantity;
                    $beers[] = $beer;
                }
                $order->price = $price;
                $order->beers = $beers;
                $allOrders[] = $order;
            }
            dd($orders);
            return view("users.show", ["user" => $user, "orders" => $allOrders]);
        } else {
            abort(404);
        }
    }
}
