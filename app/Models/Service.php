<?php

namespace App\Models;

use App\Traits\OptimizedServiceItems;
use App\Traits\UsesUlid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, OptimizedServiceItems, UsesUlid;

    protected $fillable = [
        'project_id',
        'service_name',
        'service_type',
        'form_category',
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

    // Form categories
    const CATEGORY_TKDN_JASA = 'tkdn_jasa';

    const CATEGORY_TKDN_BARANG_JASA = 'tkdn_barang_jasa';

    public static function getServiceTypes()
    {
        return [
            self::TYPE_PROJECT => 'Jasa Proyek',
            self::TYPE_EQUIPMENT => 'Jasa Alat Kerja',
            self::TYPE_CONSTRUCTION => 'Jasa Konstruksi',
        ];
    }

    public static function getFormCategories()
    {
        return [
            self::CATEGORY_TKDN_JASA => 'TKDN Jasa (Form 3.1 - 3.5)',
            self::CATEGORY_TKDN_BARANG_JASA => 'TKDN Barang & Jasa (Form 4.1 - 4.7)',
        ];
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function items()
    {
        return $this->hasMany(ServiceItem::class);
    }

    public function itemsOrdered()
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
            self::TYPE_PROJECT => 'Formulir 3.1: TKDN Jasa untuk Overhead & Manajemen',
            self::TYPE_EQUIPMENT => 'Formulir 3.2: TKDN Jasa untuk Alat / Fasilitas Kerja',
            self::TYPE_CONSTRUCTION => 'Formulir 3.3: TKDN Jasa untuk Konstruksi Fabrikasi',
            default => 'Formulir TKDN Jasa',
        };
    }

    public function getFormCategoryLabel()
    {
        return self::getFormCategories()[$this->form_category] ?? 'Unknown';
    }

    public function getAvailableForms()
    {
        return match ($this->form_category) {
            self::CATEGORY_TKDN_JASA => [
                '3.1' => 'Overhead & Manajemen',
                '3.2' => 'Alat Kerja / Fasilitas',
                '3.3' => 'Konstruksi & Fabrikasi',
                '3.4' => 'Peralatan (Jasa Umum)',
                '3.5' => 'Summary',
            ],
            self::CATEGORY_TKDN_BARANG_JASA => [
                '4.1' => 'Material (Bahan Baku)',
                '4.2' => 'Peralatan (Barang Jadi)',
                '4.3' => 'Overhead & Manajemen',
                '4.4' => 'Alat Kerja / Fasilitas',
                '4.5' => 'Konstruksi & Fabrikasi',
                '4.6' => 'Peralatan (Jasa Umum)',
                '4.7' => 'Summary',
            ],
            default => [],
        };
    }

    /**
     * Get forms that should be generated based on master data classifications
     */
    public function getFormsToGenerate(): array
    {
        $forms = [];

        // Get all unique classifications from master data in this project
        $classifications = $this->getProjectClassifications();

        // Get project type for proper form mapping
        $projectType = $this->project ? $this->project->project_type : null;

        foreach ($classifications as $classification) {
            $formNumbers = \App\Models\Material::getFormNumbersForClassification($classification, $projectType);
            foreach ($formNumbers as $formNumber) {
                $forms[$formNumber] = $this->getFormTitleForNumber($formNumber);
            }
        }

        return $forms;
    }

    /**
     * Get all classifications used in this project's master data
     */
    private function getProjectClassifications(): array
    {
        $classifications = collect();

        // Get classifications from HPP items through estimation items
        $hppItems = \App\Models\HppItem::whereHas('hpp', function ($query) {
            $query->where('project_id', $this->project_id);
        })->with('estimationItem.worker', 'estimationItem.material', 'estimationItem.equipment')->get();

        foreach ($hppItems as $hppItem) {
            if ($hppItem->estimationItem) {
                if ($hppItem->estimationItem->worker && $hppItem->estimationItem->worker->classification_tkdn) {
                    $classifications->push($hppItem->estimationItem->worker->classification_tkdn);
                }
                if ($hppItem->estimationItem->material && $hppItem->estimationItem->material->classification_tkdn) {
                    $classifications->push($hppItem->estimationItem->material->classification_tkdn);
                }
                if ($hppItem->estimationItem->equipment && $hppItem->estimationItem->equipment->classification_tkdn) {
                    $classifications->push($hppItem->estimationItem->equipment->classification_tkdn);
                }
            }
        }

        return $classifications->unique()->values()->toArray();
    }

    /**
     * Get form title for a specific form number
     */
    private function getFormTitleForNumber(string $formNumber): string
    {
        return match ($formNumber) {
            '3.1' => 'Overhead & Manajemen',
            '3.2' => 'Alat Kerja / Fasilitas',
            '3.3' => 'Konstruksi & Fabrikasi',
            '3.4' => 'Peralatan (Jasa Umum)',
            '3.5' => 'Summary',
            '4.1' => 'Material (Bahan Baku)',
            '4.2' => 'Peralatan (Barang Jadi)',
            '4.3' => 'Overhead & Manajemen',
            '4.4' => 'Alat Kerja / Fasilitas',
            '4.5' => 'Konstruksi & Fabrikasi',
            '4.6' => 'Peralatan (Jasa Umum)',
            '4.7' => 'Summary',
            default => 'Unknown Form',
        };
    }
}
