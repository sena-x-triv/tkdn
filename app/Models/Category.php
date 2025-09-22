<?php

namespace App\Models;

use App\Traits\UsesUlid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, UsesUlid;

    protected $fillable = [
        'name',
        'code',
        'tkdn_type',
        'form_mapping',
    ];

    // TKDN Types
    const TKDN_TYPE_JASA = 'tkdn_jasa';
    const TKDN_TYPE_BARANG_JASA = 'tkdn_barang_jasa';

    public static function getTkdnTypes()
    {
        return [
            self::TKDN_TYPE_JASA => 'TKDN Jasa (Form 3.1 - 3.5)',
            self::TKDN_TYPE_BARANG_JASA => 'TKDN Barang & Jasa (Form 4.1 - 4.7)',
        ];
    }

    /**
     * Get available classification categories from existing data
     */
    public static function getAvailableClassifications()
    {
        return self::whereNotNull('form_mapping')
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();
    }

    /**
     * Get form mapping for new classification
     */
    public static function getFormMapping()
    {
        return [
            // Form 3.x (TKDN Jasa)
            '3.1' => 'Overhead & Manajemen',
            '3.2' => 'Alat / Fasilitas Kerja',
            '3.3' => 'Konstruksi Fabrikasi',
            '3.4' => 'Peralatan (Jasa Umum)',
            '3.5' => 'Summary',
            
            // Form 4.x (TKDN Barang & Jasa)
            '4.1' => 'Material (Bahan Baku)',
            '4.2' => 'Peralatan (Barang Jadi)',
            '4.3' => 'Overhead & Manajemen',
            '4.4' => 'Alat / Fasilitas Kerja',
            '4.5' => 'Konstruksi & Fabrikasi',
            '4.6' => 'Peralatan (Jasa Umum)',
            '4.7' => 'Summary'
        ];
    }

    /**
     * Get categories by form mapping
     */
    public static function getByFormMapping(string $formCode)
    {
        return self::where('form_mapping', $formCode)->first();
    }

    /**
     * Get categories by classification name
     */
    public static function getByClassificationName(string $classificationName)
    {
        return self::where('name', $classificationName)->get();
    }

    public function getTkdnTypeLabelAttribute()
    {
        return self::getTkdnTypes()[$this->tkdn_type] ?? 'Tidak Diketahui';
    }

    protected $keyType = 'string';
    public $incrementing = false;
}