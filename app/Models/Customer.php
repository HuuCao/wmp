<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'customer_name',
        'customer_code',
        'address',
        'email',
        'phone',
        'is_active'
    ];
}
