<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUlid;

class Hpp extends Model
{
    use UsesUlid;

    protected $table = 'hpps';

    protected $fillable = [
        'code',
        'title',
        'company_name',
        'work_description',
        'sub_total_hpp',
        'overhead_percentage',
        'overhead_amount',
        'margin_percentage',
        'margin_amount',
        'sub_total',
        'ppn_percentage',
        'ppn_amount',
        'grand_total',
        'notes',
        'status',
    ];

    protected $casts = [
        'overhead_percentage' => 'decimal:2',
        'overhead_amount' => 'decimal:2',
        'margin_percentage' => 'decimal:2',
        'margin_amount' => 'decimal:2',
        'sub_total_hpp' => 'decimal:2',
        'sub_total' => 'decimal:2',
        'ppn_percentage' => 'decimal:2',
        'ppn_amount' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(HppItem::class, 'hpp_id');
    }

    public function estimation()
    {
        return $this->belongsTo(Estimation::class, 'estimation_id');
    }
}
