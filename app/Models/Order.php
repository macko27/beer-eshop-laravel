<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        "name",
        "phoneNumber",
        "email",
        "state",
        "address",
        "psc",
        "description"
    ];

    use HasFactory;

}
