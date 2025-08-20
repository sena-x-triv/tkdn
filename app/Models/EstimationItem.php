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
}
