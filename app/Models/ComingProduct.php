<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ComingProduct extends Model
{
	use HasFactory, LogsActivity;

	public function getActivitylogOptions(): LogOptions
	{
		return LogOptions::defaults()
			->useLogName('Transaksi Barang Masuk')
			->logOnly(['user.name', 'company.name', 'product.name', 'price', 'qty', 'supplier.name']);
	}

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var string[]
	 */
	protected $fillable = ['code', 'date', 'product_id', 'price', 'qty', 'user_id', 'company_id', 'supplier_id'];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = ['code' => 'string', 'date' => 'date:d/m/Y', 'price' => 'integer', 'qty' => 'integer', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function company()
	{
		return $this->belongsTo(\App\Models\Company::class);
	}

	public function supplier()
	{
		return $this->belongsTo(\App\Models\Supplier::class);
	}
}
