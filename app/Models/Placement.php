<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var string[]
	 */
	protected $fillable = ['date', 'room_id', 'staff_id', 'description', 'type', 'created_by', 'company_id'];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = ['date' => 'date:d/m/Y', 'description' => 'string', 'type' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

	public function room()
	{
		return $this->belongsTo(\App\Models\Room::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
	}

	public function staff()
	{
		return $this->belongsTo(\App\Models\User::class, 'staff_id', 'id');
	}

	public function company()
	{
		return $this->belongsTo(\App\Models\Company::class);
	}
}
