<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['invoice_number', 'asset_id', 'company_id', 'description', 'price', 'quantity'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['description' => 'string', 'price' => 'integer', 'quantity' => 'integer', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    public function procurement()
    {
        return $this->belongsTo(\App\Models\Procurement::class, 'invoice_number');
    }

    public function asset()
    {
        return $this->belongsTo(\App\Models\Asset::class);
    }

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }
}
