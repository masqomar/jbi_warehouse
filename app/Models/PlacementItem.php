<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacementItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['placement_id', 'asset_item_id', 'staff_id', 'company_id', 'status'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    public function placement()
    {
        return $this->belongsTo(\App\Models\Placement::class);
    }

    public function asset_item()
    {
        return $this->belongsTo(\App\Models\AssetItem::class, 'asset_item_id', 'full_code');
    }

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public function staff()
    {
        return $this->belongsTo(\App\Models\User::class, 'staff_id', 'id');
    }
}
