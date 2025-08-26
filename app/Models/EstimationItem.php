<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimationItem extends Model
{
    use HasFactory;

    protected $table = 'estimation_items';

    protected $fillable = [
        'estimation_id',
        'category',
        'reference_id',
        'equipment_name',
        'code',
        'coefficient',
        'unit_price',
        'total_price',
        'tkdn_classification',
        'tkdn_value',
    ];

    protected $casts = [
        'coefficient' => 'decimal:3',
        'unit_price' => 'integer',
        'total_price' => 'integer',
        'tkdn_value' => 'decimal:2',
    ];

    public function estimation()
    {
        return $this->belongsTo(Estimation::class, 'estimation_id');
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class, 'reference_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'reference_id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'reference_id');
    }

    /**
     * Get TKDN classification based on TKDN value
     */
    public function getTkdnClassificationAttribute($value)
    {
        if ($value) {
            return $value;
        }

        if ($this->tkdn_value === null) {
            return '3.7'; // Default to highest TKDN
        }

        $tkdnValue = (float) $this->tkdn_value;

        if ($tkdnValue <= 25) {
            return '3.1';
        }
        if ($tkdnValue <= 35) {
            return '3.2';
        }
        if ($tkdnValue <= 45) {
            return '3.3';
        }
        if ($tkdnValue <= 55) {
            return '3.4';
        }
        if ($tkdnValue <= 65) {
            return '3.5';
        }
        if ($tkdnValue <= 75) {
            return '3.6';
        }

        return '3.7';
    }
}
