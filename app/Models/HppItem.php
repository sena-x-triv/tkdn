<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUlid;

class HppItem extends Model
{
    use UsesUlid;

    protected $table = 'hpp_items';

    protected $fillable = [
        'hpp_id',
        'estimation_item_id',
        'item_number',
        'description',
        'tkdn_classification',
        'volume',
        'unit',
        'duration',
        'duration_unit',
        'unit_price',
        'total_price',
    ];

    protected $casts = [
        'volume' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function hpp()
    {
        return $this->belongsTo(Hpp::class, 'hpp_id');
    }

    public function estimationItem()
    {
        return $this->belongsTo(EstimationItem::class, 'estimation_item_id');
    }
}
