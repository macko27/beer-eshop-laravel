<?php

use App\Http\Controllers\BeerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home/index');
});

//get all beers
Route::get('/beers', [BeerController::class, "beers"]);

//create beer
Route::get("/beers/create", [BeerController::class, "create"])->middleware("auth");

//save beer
Route::post("/beers", [BeerController::class, "save"])->middleware("auth");

Route::delete("/beers/{beer}", [BeerController::class, "delete"])->middleware("auth");

Route::get("/beers/{beer}/edit", [BeerController::class, "edit"])->middleware("auth");

Route::put("/beers/{beer}", [BeerController::class, "update"])->middleware("auth");

//get one beer
Route::get("/beers/{beer}", [BeerController::class, "show"]);

//users-----------------------
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

Route::get("/cart/order", [OrderController::class, "show"]);

Route::post("order", [OrderController::class, "add"]);

Route::get("/{user_id}", [UserController::class, "show"])->middleware("auth");

//orders

