<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderParchuse extends Model
{
    use HasFactory;
    protected $fillable = [
        'number'
    ];
    public function products(): HasMany
    {
        return $this->hasMany(
            related: Product::class,
            foreignKey: 'order_id'
        );
    }
}
