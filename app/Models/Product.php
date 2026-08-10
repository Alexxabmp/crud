<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'category',
        'description',
        'price',
        'stock_quantity',
        'expiry_date',
        'is_active',
    ];

    protected $casts = [
        'price'         => 'decimal:2',
        'stock_quantity' => 'integer',
        'expiry_date'   => 'date',
        'is_active'     => 'boolean',
    ];

    // Category options as a constant for reuse in views/validation
    public static array $categories = [
        'Pain Relievers (Analgesics)',
        'Infection Fighters (Antibiotics)',
        'Stomach Acid Reducers (Antacids)',
    ];
}
