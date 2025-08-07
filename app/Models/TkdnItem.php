<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TkdnItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'tkdn_classification',
        'unit',
        'unit_price',
        'description',
        'is_active',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Scope untuk item yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk filter berdasarkan klasifikasi TKDN
     */
    public function scopeByClassification($query, $classification)
    {
        return $query->where('tkdn_classification', $classification);
    }

    /**
     * Format harga untuk display
     */
    public function getFormattedUnitPriceAttribute()
    {
        return 'Rp ' . number_format($this->unit_price, 0, ',', '.');
    }

    /**
     * Hitung total harga berdasarkan volume
     */
    public function calculateTotalPrice($volume, $duration = 1)
    {
        return $this->unit_price * $volume * $duration;
    }
}
