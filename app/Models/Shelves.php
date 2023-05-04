<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelves extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'shelves_name',
        'location',
        'description',
        'is_active'
    ];
}
