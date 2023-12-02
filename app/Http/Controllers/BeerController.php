<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BeerController extends Controller
{
    public function beers() {
        return view("beers.beers", ["beers" => Beer::latest()->paginate(8)]);
    }

    public function show(Beer $beer) {
        $beerId = $beer->id;
        $userId = auth()->id();
        $reviews = Review::where("beer_id", $beerId)->where("user_id", $userId)->get();
        return view("beers.beer", [
            "beer" => $beer,
            "reviews" => $reviews
        ]);
    }

    public function create() {
        return view("beers.create");
    }

    public function save(Request $request) {
        if (auth()->user()?->name != "admin") {
            abort(403, "Unauthorized Action");
        }
        $newBeer = $request->validate([
            "name" => ["required", Rule::unique("beers", "name"), "max:20"],
            "style" => "required|max:10",
            "type" => "required|max:10",
            "price" => ["required", "numeric"],
            "degree" => ["required", "numeric"],
            "brewery" => "required",
            "description" => "required"
        ]);

        if($request->hasFile("picture")) {
            $newBeer["picture"] = $request->file("picture")->store("pictures", "public");
        }

        Beer::create($newBeer);
        return redirect("/")->with("message", "Pivo pridané.");
    }

    public function edit(Beer $beer) {
        return view("beers.edit", ["beer" => $beer]);
    }

    public function update(Request $request, Beer $beer) {
        if (auth()->user()?->name != "admin") {
            abort(403, "Unauthorized Action");
        }
        $updatedBeer = $request->validate([
            "name" => "required|max:20",
            "style" => "required|max:10",
            "type" => "required|max:10",
            "price" => ["required", "numeric"],
            "degree" => ["required", "numeric"],
            "brewery" => "required",
            "description" => "required"
        ]);
        if($request->hasFile("picture")) {
            $updatedBeer["picture"] = $request->file("picture")->store("pictures", "public");
        }

        $beer->update($updatedBeer);
        return redirect("/beers/$beer->id");
    }

    public function delete(Beer $beer) {
        if (auth()->user()?->name != "admin") {
            abort(403, "Unauthorized Action");
        }
        $beer->delete();
        return redirect("/")->with("message", "Pivo vymazané!");
    }
}
