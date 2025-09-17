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

    public function getTkdnTypeLabelAttribute()
    {
        return self::getTkdnTypes()[$this->tkdn_type] ?? 'Tidak Diketahui';
    }

    protected $keyType = 'string';

    public $incrementing = false;
}
