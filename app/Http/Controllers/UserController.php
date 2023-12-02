<?php

namespace App\Http\Controllers;

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

        return redirect("/");
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/");
    }
}
