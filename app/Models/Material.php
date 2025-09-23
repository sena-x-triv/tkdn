<?php

namespace App\Models;

use App\Traits\UsesUlid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory, UsesUlid;

    protected $table = 'material';

    protected $primaryKey = 'id';

    protected $fillable = [
        'code',
        'name',
        'specification',
        'category_id',
        'classification_tkdn',
        'brand',
        'tkdn',
        'price',
        'unit',
        'link',
        'price_inflasi',
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

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
