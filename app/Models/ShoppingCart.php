<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    protected function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}