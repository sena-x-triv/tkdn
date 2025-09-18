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

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
