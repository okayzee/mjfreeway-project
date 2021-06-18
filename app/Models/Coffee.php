<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coffee extends Model
{
    use HasFactory;

    const SAFE_COFFEE_LEVEL = 500;

    protected $fillable = [
        "name",
        "serving",
        "description"
    ];
}
