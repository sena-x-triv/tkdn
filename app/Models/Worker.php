<?php

namespace App\Models;

use App\Traits\UsesUlid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory, UsesUlid;

    protected $table = 'workers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'code', 'name', 'unit', 'category_id', 'classification_tkdn', 'price', 'tkdn', 'location',
    ];

    /**
     * Get available TKDN classification options
     */
    public static function getClassificationOptions(): array
    {
        return [
            '3.1' => '3.1 - Overhead & Manajemen',
            '3.2' => '3.2 - Alat / Fasilitas Kerja',
            '3.3' => '3.3 - Konstruksi Fabrikasi',
            '3.4' => '3.4 - Peralatan (Jasa Umum)',
            '3.5' => '3.5 - Summary',
            '4.1' => '4.1 - Material (Bahan Baku)',
            '4.2' => '4.2 - Peralatan (Barang Jadi)',
            '4.3' => '4.3 - Overhead & Manajemen',
            '4.4' => '4.4 - Alat / Fasilitas Kerja',
            '4.5' => '4.5 - Konstruksi & Fabrikasi',
            '4.6' => '4.6 - Peralatan (Jasa Umum)',
            '4.7' => '4.7 - Summary',
        ];
    }

    /**
     * Get new classification mapping
     */
    public static function getNewClassificationMapping(): array
    {
        return Category::getFormMapping();
    }

    /**
     * Get classification label with new format
     */
    public function getClassificationLabelAttribute(): string
    {
        $mapping = self::getNewClassificationMapping();
        $formCode = $this->classification_tkdn;
        
        return $mapping[$formCode] ?? $formCode;
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
