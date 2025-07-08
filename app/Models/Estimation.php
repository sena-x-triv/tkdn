<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUlid;

class Estimation extends Model
{
    use UsesUlid;

    protected $table = 'estimations';

    protected $fillable = [
        'code',
        'title',
        'total',
        'margin',
        'total_unit_price',
    ];

    public function items()
    {
        return $this->hasMany(EstimationItem::class, 'estimation_id');
    }
} 