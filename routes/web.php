<?php

use App\Http\Controllers\BeerController;
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
Route::get("/beers/create", [BeerController::class, "create"]);

//save beer
Route::post("/beers", [BeerController::class, "save"]);

Route::delete("/beers/{beer}", [BeerController::class, "delete"]);

Route::get("/beers/{beer}/edit", [BeerController::class, "edit"]);

Route::put("/beers/{beer}", [BeerController::class, "update"]);

//get one beer
Route::get("/beers/{beer}", [BeerController::class, "show"]);


Route::get("/login", [UserController::class, "login"]);

Route::post("/users/authenticate", [UserController::class, "authenticate"]);

Route::get("/register", [UserController::class, "register"]);

Route::post("/users", [UserController::class, "registerNewUser"]);
