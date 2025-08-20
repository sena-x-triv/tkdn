<?php

namespace App\Models;

use App\Traits\UsesUlid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, UsesUlid;

    protected $fillable = [
        'project_id',
        'service_name',
        'service_type',
        'tkdn_classification',
        'provider_name',
        'provider_address',
        'user_name',
        'document_number',
        'total_domestic_cost',
        'total_foreign_cost',
        'total_cost',
        'tkdn_percentage',
        'status',
    ];

    protected $casts = [
        'total_domestic_cost' => 'decimal:2',
        'total_foreign_cost' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'tkdn_percentage' => 'decimal:2',
    ];

    // Service types
    const TYPE_PROJECT = 'project';

    const TYPE_EQUIPMENT = 'equipment';

    const TYPE_CONSTRUCTION = 'construction';

    public static function getServiceTypes()
    {
        return [
            self::TYPE_PROJECT => 'Jasa Proyek',
            self::TYPE_EQUIPMENT => 'Jasa Alat Kerja',
            self::TYPE_CONSTRUCTION => 'Jasa Konstruksi',
        ];
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function items()
    {
        return $this->hasMany(ServiceItem::class)->orderBy('item_number');
    }

    public function calculateTotals()
    {
        $this->total_domestic_cost = $this->items->sum('domestic_cost');
        $this->total_foreign_cost = $this->items->sum('foreign_cost');
        $this->total_cost = $this->total_domestic_cost + $this->total_foreign_cost;

        if ($this->total_cost > 0) {
            $this->tkdn_percentage = ($this->total_domestic_cost / $this->total_cost) * 100;
        } else {
            $this->tkdn_percentage = 0;
        }

        $this->save();
    }

    public function getStatusBadgeClass()
    {
        return match ($this->status) {
            'draft' => 'bg-gray-100 text-gray-800',
            'submitted' => 'bg-blue-100 text-blue-800',
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            'generated' => 'bg-purple-100 text-purple-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getServiceTypeLabel()
    {
        return self::getServiceTypes()[$this->service_type] ?? 'Unknown';
    }

    public function getFormTitle()
    {
        return match ($this->service_type) {
            self::TYPE_PROJECT => 'Formulir 3.1: TKDN Jasa untuk Manajemen Proyek dan Perekayasaan',
            self::TYPE_EQUIPMENT => 'Formulir 3.2: TKDN Jasa untuk Alat Kerja dan Peralatan',
            self::TYPE_CONSTRUCTION => 'Formulir 3.3: TKDN Jasa untuk Konstruksi dan Pembangunan',
            default => 'Formulir TKDN Jasa',
        };
    }
}
