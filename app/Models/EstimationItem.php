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
    public function getClassificationTkdnAttribute(): ?int
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
     * Get classification TKDN name from master data
     */
    public function getClassificationTkdnNameAttribute(): ?string
    {
        $code = $this->getClassificationTkdnAttribute();
        if (! $code) {
            return null;
        }

        return \App\Helpers\TkdnClassificationHelper::getNameByCode($code);
    }

    /**
     * Scope untuk filter berdasarkan project type
     */
    public function scopeForProjectType($query, string $projectType)
    {
        $classifications = \App\Helpers\TkdnClassificationHelper::getClassificationsForProjectType($projectType);

        // Convert classification names to codes
        $classificationCodes = [];
        foreach ($classifications as $classificationName) {
            $code = \App\Helpers\TkdnClassificationHelper::getCodeByName($classificationName);
            if ($code) {
                $classificationCodes[] = $code;
            }
        }

        return $query->where(function ($q) use ($classificationCodes) {
            $q->whereHas('worker', function ($workerQuery) use ($classificationCodes) {
                $workerQuery->whereIn('classification_tkdn', $classificationCodes);
            })->orWhereHas('material', function ($materialQuery) use ($classificationCodes) {
                $materialQuery->whereIn('classification_tkdn', $classificationCodes);
            })->orWhereHas('equipment', function ($equipmentQuery) use ($classificationCodes) {
                $equipmentQuery->whereIn('classification_tkdn', $classificationCodes);
            });
        });
    }
}
