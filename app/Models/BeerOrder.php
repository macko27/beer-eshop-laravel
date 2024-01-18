<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeerOrder extends Model
{
    protected $fillable = [
        "order_id",
        "beer_id",
        "quantity"
    ];

    use HasFactory;
}
