<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolkitItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['quantity', 'toolkit_id', 'member_id', 'product_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['quantity' => 'integer', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

	public function toolkit()
	{
		return $this->belongsTo(\App\Models\Toolkit::class);
	}

	public function member()
	{
		return $this->belongsTo(\App\Models\Member::class);
	}

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
