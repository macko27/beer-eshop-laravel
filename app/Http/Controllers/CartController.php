<?php

namespace App\Http\Controllers;


class CartController extends Controller
{
    public function add() {
        $beerID = request()->input("beerID");
        $quantity = request()->input("quantity");
        return response()->json(['message' => "Položka $beerID bola úspešne pridaná do košíka v množstve $quantity."]);
    }
}
