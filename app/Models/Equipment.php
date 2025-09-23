<?php

namespace App\Models;

use App\Traits\UsesUlid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory, UsesUlid;

    protected $table = 'equipment';

    protected $fillable = [
        'code',
        'name',
        'category_id',
        'classification_tkdn',
        'tkdn',
        'period',
        'price',
        'description',
        'location',
    ];

    protected $casts = [
        'classification_tkdn' => 'integer',
    ];

    /**
     * Get available TKDN classification options
     */
    public static function getClassificationOptions(): array
    {
        return \App\Helpers\TkdnClassificationHelper::getSelectOptions();
    }

    /**
     * Get form numbers for a classification based on project type
     */
    public static function getFormNumbersForClassification(int $classificationCode, ?string $projectType = null): array
    {
        $classification = \App\Helpers\TkdnClassificationHelper::getClassificationByCode($classificationCode);
        if (! $classification) {
            return [];
        }

        return \App\Helpers\TkdnClassificationHelper::getFormNumbersForClassification($classification['name'], $projectType);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Check if equipment is disposable (single use)
     */
    public function isDisposable()
    {
        return $this->period == 0;
    }

    /**
     * Get equipment type label
     */
    public function getTypeLabel()
    {
        return $this->isDisposable() ? 'Sekali Pakai' : 'Dapat Dipakai Ulang';
    }

    /**
     * Get equipment type badge class
     */
    public function getTypeBadgeClass()
    {
        return $this->isDisposable() ? 'badge-danger' : 'badge-success';
    }
}
