<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductMovement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movement extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo',
        'order_id'
    ];
    // public function products(): BelongsToMany
    // {
    //     return $this->belongsToMany(
    //         Product::class,
    //         'product_movement'
    //     )
    //         ->withPivot('quantity')
    //         ->withTimestamps();
    // }
    public function movementproduct(): HasMany
    {
        return $this->hasMany(ProductMovement::class);
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(
            related: OrderParchuse::class,
            foreignKey: 'order_id',
        );
    }
}
