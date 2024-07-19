<?php

namespace App\Models;

use App\Models\Movement;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductMovement extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'movement_id',
        'quantity',
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function movement(): BelongsTo
    {
        return $this->belongsTo(Movement::class);
    }
}
