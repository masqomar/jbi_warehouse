<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electricity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['meter_number', 'building_id', 'company_id', 'amount', 'note', 'extra_note'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['meter_number' => 'string', 'amount' => 'integer', 'note' => 'string', 'extra_note' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    public function building()
    {
        return $this->belongsTo(\App\Models\Building::class);
    }
    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }
}
