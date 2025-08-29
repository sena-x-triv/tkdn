<?php

namespace App\Models;

use App\Traits\UsesUlid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimationItem extends Model
{
    use HasFactory, UsesUlid;

    protected $table = 'estimation_items';

    protected $fillable = [
        'estimation_id',
        'category',
        'reference_id',
        'code',
        'coefficient',
        'unit_price',
        'total_price',
    ];

    protected $casts = [
        'coefficient' => 'decimal:3',
        'unit_price' => 'integer',
        'total_price' => 'integer',
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
