<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    protected $fillable = ["name", "style", "type", "price", "degree", "brewery", "description", "picture"];

    use HasFactory;

}
