<?php

use App\Http\Controllers\BeerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home/index');
});

Route::get('/beers', [BeerController::class, "beers"]);

Route::get("/beers/create", [BeerController::class, "create"])->middleware("auth");

Route::post("/beers", [BeerController::class, "save"])->middleware("auth");

Route::delete("/beers/{beer}", [BeerController::class, "delete"])->middleware("auth");

Route::get("/beers/{beer}/edit", [BeerController::class, "edit"])->middleware("auth");

Route::put("/beers/{beer}", [BeerController::class, "update"])->middleware("auth");

Route::get("/beers/{beer}", [BeerController::class, "show"]);

Route::get("/login", [UserController::class, "login"])->name("login")->middleware("guest");

Route::post("/users/authenticate", [UserController::class, "authenticate"]);

Route::get("/register", [UserController::class, "register"])->middleware("guest");

Route::post("/users", [UserController::class, "registerNewUser"]);

Route::post("/logout", [UserController::class, "logout"])->middleware("auth");

Route::get("/cart", [CartController::class, "show"]);

Route::get("/cart-amount", [CartController::class, "amount"]);

Route::post("/add-to-cart", [CartController::class, "add"]);

Route::post("update-cart", [CartController::class, "update"]);

Route::delete("/cart-delete", [CartController::class, "delete"]);

Route::get("/cart/order", [OrderController::class, "form"]);

Route::post("/order", [OrderController::class, "add"]);

Route::get("/order/{order_id}/cancel", [OrderController::class, "cancel"])->middleware("auth");

Route::get("/order/{order_id}/delete", [OrderController::class, "delete"])->middleware("auth");

Route::get("/order/{order_id}/edit", [OrderController::class, "edit"])->middleware("auth");

Route::post("/order/{order_id}/update", [OrderController::class, "update"])->middleware("auth");

Route::get("/order/{order_id}/confirm", [OrderController::class, "confirm"])->middleware("auth");

Route::get("/order/{order_id}/send", [OrderController::class, "send"])->middleware("auth");

Route::get("{user_name}/order/{order_id}", [OrderController::class, "get"])->middleware("auth");

Route::get("/{user_id}", [OrderController::class, "show"])->middleware("auth");


