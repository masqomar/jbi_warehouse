<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutationFrom extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['mutation_id', 'placement_id', 'asset_item_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

public function mutation()
	{
		return $this->belongsTo(\App\Models\Mutation::class);
	}

	public function placement()
	{
		return $this->belongsTo(\App\Models\Placement::class);
	}

	public function asset_item()
	{
		return $this->belongsTo(\App\Models\AssetItem::class);
	}
}
