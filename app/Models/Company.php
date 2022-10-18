<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['code', 'name', 'phone', 'address', 'status'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['code' => 'string', 'name' => 'string', 'phone' => 'string', 'address' => 'string', 'status' => 'boolean', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];
}
