<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity',
        'price'
    ];

    protected function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    protected function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}