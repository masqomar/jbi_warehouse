<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toolkit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['taken_date', 'member_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['taken_date' => 'date:d/m/Y', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

	public function member()
	{
		return $this->belongsTo(\App\Models\Member::class);
	}
}
