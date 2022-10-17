<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['reg_number', 'name', 'gender', 'phone', 'address', 'period', 'program', 'education', 'tshirt', 'user_id', 'company_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['reg_number' => 'string', 'name' => 'string', 'gender' => 'string', 'phone' => 'string', 'address' => 'string', 'period' => 'date:d/m/Y', 'program' => 'string', 'education' => 'string', 'tshirt' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function company()
	{
		return $this->belongsTo(\App\Models\Company::class);
	}
}
