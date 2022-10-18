<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetItem extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var string[]
	 */
	protected $fillable = ['code', 'full_code', 'price', 'asset_id', 'purchasing_no', 'purchasing_date', 'status', 'category_id', 'company_id', 'created_by', 'updated_by'];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = ['code' => 'integer', 'full_code' => 'string', 'price' => 'integer', 'purchasing_no' => 'string', 'purchasing_date' => 'date:d/m/Y', 'status' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

	public function asset()
	{
		return $this->belongsTo(\App\Models\Asset::class);
	}

	public function category()
	{
		return $this->belongsTo(\App\Models\Category::class);
	}

	public function company()
	{
		return $this->belongsTo(\App\Models\Company::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
	}

	public function placement_item()
	{
		return $this->hasOne(PlacementItem::class, 'asset_item_id', 'full_code');
	}

	public static function boot()
	{
		parent::boot();

		static::creating(function ($model) {
			$model->code = AssetItem::where('category_id', $model->category_id)->where('company_id', $model->company_id)->max('code') + 1;
			$model->full_code = str_pad($model->code, 3, '0', STR_PAD_LEFT) . '/' . $model->category->code . '/Invent/' . $model->company->code . '/' . date('m', strtotime($model->purchasing_date)) . '/' . date('Y', strtotime($model->purchasing_date));
		});
	}
}
