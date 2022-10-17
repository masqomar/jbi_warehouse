<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProgram extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['product_id', 'program_id'];
    protected $table = 'product_program';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function program()
    {
        return $this->belongsTo(\App\Models\Program::class);
    }
}
