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

    /**
     * Get classification TKDN from master data
     */
    public function getClassificationTkdnAttribute(): ?string
    {
        switch ($this->category) {
            case 'worker':
                return $this->worker?->classification_tkdn;
            case 'material':
                return $this->material?->classification_tkdn;
            case 'equipment':
                return $this->equipment?->classification_tkdn;
            default:
                return null;
        }
    }

    /**
     * Scope untuk filter berdasarkan project type
     */
    public function scopeForProjectType($query, string $projectType)
    {
        $classifications = $projectType === 'tkdn_jasa'
            ? ['3.1', '3.2', '3.3', '3.4', '3.5']
            : ['4.1', '4.2', '4.3', '4.4', '4.5', '4.6', '4.7'];

        return $query->where(function ($q) use ($classifications) {
            $q->whereHas('worker', function ($workerQuery) use ($classifications) {
                $workerQuery->whereIn('classification_tkdn', $classifications);
            })->orWhereHas('material', function ($materialQuery) use ($classifications) {
                $materialQuery->whereIn('classification_tkdn', $classifications);
            })->orWhereHas('equipment', function ($equipmentQuery) use ($classifications) {
                $equipmentQuery->whereIn('classification_tkdn', $classifications);
            });
        });
    }
}
