<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_product',
        'name_product',
        'import_price',
        'export_price',
        'type',
        'manufacture_date',
        'expiration_date',
        'status',
        'image',
        'unit_id',
        'category_id',
        'sheft_id'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }
}
