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
        'sku',
        'import_price',
        'export_price',
        'type',
        'manufacture_date',
        'expiration_date',
        'quantity',
        'status',
        'description',
        'image',
        'unit_id',
        'category_id',
        'shelves_id'
    ];

    public function units()
    {
        return $this->belongsTo(Unit::class, "unit_id", "id");
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }

    public function shelves()
    {
        return $this->belongsTo(Shelves::class, "shelves_id", "id");
    }
}
