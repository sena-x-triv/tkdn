<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUlid;

class EstimationItem extends Model
{

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
} 