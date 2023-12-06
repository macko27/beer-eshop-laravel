<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    public function delete(Review $review) {
        if (auth()->user()?->name != "admin") {
            abort(403, "Unauthorized Action");
        }
        $review->delete();
        return redirect("/");
    }

    public function add(Request $request) {
        if (!auth()) {
            abort(403, "Unauthorized Action");
        }

        $user_id = auth()->id();
        $beer_id = $request->input("beerID");
        $text = $request->input("text");
        $numberOfStars = $request->input("numberOfStars");

        $validator = Validator::make($request->all(), [
            'text' => 'required|string',
            'numberOfStars' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $review = new Review();
        $review->user_id = $user_id;
        $review->beer_id = $beer_id;
        $review->text = $text;
        $numberOfStars->numberOfStars = $numberOfStars;

        $review->save();

        return response()->json(['message' => 'Recenzia bola úspešne pridaná']);
    }
}
