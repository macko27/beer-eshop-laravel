<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function delete(Review $review) {
        if (auth()->user()?->name != "admin") {
            abort(403, "Unauthorized Action");
        }
        $review->delete();
        return redirect("/");
    }
}
