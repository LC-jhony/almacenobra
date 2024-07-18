<?php

namespace App\Models;

use App\Models\Category;
use App\Models\OrderParchuse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'pu',
        'um',
        'order_id',
        'quantity',
        'category_id',
    ];
    public function order(): BelongsTo
    {
        return $this->belongsTo(
            related: OrderParchuse::class,
            foreignKey: 'order_id',
        );
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            related: Category::class,
            foreignKey: 'category_id'
        );
    }
}
