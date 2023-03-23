<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Transaksi Barang')
            ->logOnly(['user.name', 'company.name', 'name', 'full_code', 'quantity']);
    }

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['image'];

    public function unit()
    {
        return $this->belongsTo(\App\Models\Unit::class);
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
        return $this->belongsTo(\App\Models\User::class);
    }

    public function coming_product()
    {
        return $this->hasMany(\App\Models\ComingProduct::class);
    }

    public function transaction_detail()
    {
        return $this->hasMany(\App\Models\TransactionDetail::class);
    }



    public function getImageAttribute()
    {
        return $this->getMedia('product_image')->last();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->code = Product::where('category_id', $model->category_id)->where('company_id', $model->company_id)->max('code') + 1;
            $model->full_code = $model->category->id . '-' . $model->company->id . '-' . str_pad($model->code, 4, '0', STR_PAD_LEFT);
        });
    }
}
