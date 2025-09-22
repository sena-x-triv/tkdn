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
            'Overhead & Manajemen' => 'Overhead & Manajemen',
            'Alat Kerja / Fasilitas' => 'Alat Kerja / Fasilitas',
            'Konstruksi & Fabrikasi' => 'Konstruksi & Fabrikasi',
            'Peralatan (Jasa Umum)' => 'Peralatan (Jasa Umum)',
            'Material (Bahan Baku)' => 'Material (Bahan Baku)',
            'Peralatan (Barang Jadi)' => 'Peralatan (Barang Jadi)',
        ];
    }

    /**
     * Get form numbers for a classification based on project type
     */
    public static function getFormNumbersForClassification(string $classification, ?string $projectType = null): array
    {
        return match ($classification) {
            'Overhead & Manajemen' => $projectType === 'tkdn_jasa' ? ['3.1'] : ($projectType === 'tkdn_barang_jasa' ? ['4.3'] : ['3.1', '4.3']),
            'Alat Kerja / Fasilitas' => $projectType === 'tkdn_jasa' ? ['3.2'] : ($projectType === 'tkdn_barang_jasa' ? ['4.4'] : ['3.2', '4.4']),
            'Konstruksi & Fabrikasi' => $projectType === 'tkdn_jasa' ? ['3.3'] : ($projectType === 'tkdn_barang_jasa' ? ['4.5'] : ['3.3', '4.5']),
            'Peralatan (Jasa Umum)' => $projectType === 'tkdn_jasa' ? ['3.4'] : ($projectType === 'tkdn_barang_jasa' ? ['4.6'] : ['3.4', '4.6']),
            'Material (Bahan Baku)' => $projectType === 'tkdn_barang_jasa' ? ['4.1'] : [],
            'Peralatan (Barang Jadi)' => $projectType === 'tkdn_barang_jasa' ? ['4.2'] : [],
            default => [],
        };
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
