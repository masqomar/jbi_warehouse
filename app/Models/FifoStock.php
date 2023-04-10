<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FifoStock extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['quantity', 'price', 'date', 'product_id', 'total_price'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['quantity' => 'integer', 'price' => 'integer', 'total_price' => 'integer', 'date' => 'date:d/m/Y', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
}
