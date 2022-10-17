<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetMaintenance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['code', 'asset_item_id', 'initial_date', 'finish_date', 'finish_note', 'description', 'status', 'company_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['code' => 'string', 'initial_date' => 'date:d/m/Y', 'finish_date' => 'date:d/m/Y', 'finish_note' => 'string', 'description' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    public function asset_item()
    {
        return $this->belongsTo(\App\Models\AssetItem::class);
    }

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->code = AssetMaintenance::where('asset_item_id', $model->asset_item_id)->where('company_id', $model->company_id)->max('code') + 1;
        });
    }
}
