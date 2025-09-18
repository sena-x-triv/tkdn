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

    /**
     * Get available TKDN classification options
     */
    public static function getClassificationOptions(): array
    {
        return [
            '3.1' => '3.1 - Manajemen Proyek dan Perekayasaan',
            '3.2' => '3.2 - Alat Kerja',
            '3.3' => '3.3 - Konstruksi dan fabrikasi',
            '3.4' => '3.4 - Jasa Umum',
            '3.5' => '3.5 - Rekapitulasi',
            '4.1' => '4.1 - Material Langsung (Bahan Baku)',
            '4.2' => '4.2 - Peralatan (Barang Jadi)',
            '4.3' => '4.3 - Manajemen Proyek & Perekayasaan',
            '4.4' => '4.4 - Alat Kerja',
            '4.5' => '4.5 - Konstruksi & Fabrikasi',
            '4.6' => '4.6 - Jasa Umum',
            '4.7' => '4.7 - Rekapitulasi',
        ];
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
