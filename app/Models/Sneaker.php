<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sneaker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'brand',
        'size',
        'color',
        'stock',
        'image'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer'
    ];
}