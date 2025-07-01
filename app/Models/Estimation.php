<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUlid;

class Estimation extends Model
{
    use UsesUlid;

    protected $fillable = [
        'category', 'reference_id', 'equipment_name', 'unit', 'coefficient', 'unit_price', 'total_price'
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class, 'reference_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'reference_id');
    }
} 