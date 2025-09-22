<?php

namespace App\Services;

use App\Models\Category;

class FormClassificationService
{
    /**
     * Get form mapping untuk klasifikasi baru
     */
    public static function getFormMapping(): array
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
     * Get available forms untuk TKDN Jasa
     */
    public static function getTkdnJasaForms(): array
    {
        return [
            '3.1' => '3.1 - Overhead & Manajemen',
            '3.2' => '3.2 - Alat / Fasilitas Kerja',
            '3.3' => '3.3 - Konstruksi Fabrikasi',
            '3.4' => '3.4 - Peralatan (Jasa Umum)',
            '3.5' => '3.5 - Summary'
        ];
    }

    /**
     * Get available forms untuk TKDN Barang & Jasa
     */
    public static function getTkdnBarangJasaForms(): array
    {
        return [
            '4.1' => '4.1 - Material (Bahan Baku)',
            '4.2' => '4.2 - Peralatan (Barang Jadi)',
            '4.3' => '4.3 - Overhead & Manajemen',
            '4.4' => '4.4 - Alat / Fasilitas Kerja',
            '4.5' => '4.5 - Konstruksi & Fabrikasi',
            '4.6' => '4.6 - Peralatan (Jasa Umum)',
            '4.7' => '4.7 - Summary'
        ];
    }

    /**
     * Get classification by form code
     */
    public static function getClassificationByForm(string $formCode): ?string
    {
        $mapping = self::getFormMapping();
        return $mapping[$formCode] ?? null;
    }

    /**
     * Get forms by classification
     */
    public static function getFormsByClassification(string $classification): array
    {
        $mapping = self::getFormMapping();
        return array_keys(array_filter($mapping, function($value) use ($classification) {
            return $value === $classification;
        }));
    }

    /**
     * Get all available classifications from database
     */
    public static function getAvailableClassifications(): array
    {
        return Category::whereNotNull('form_mapping')
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();
    }

    /**
     * Check if form is summary form
     */
    public static function isSummaryForm(string $formCode): bool
    {
        return in_array($formCode, ['3.5', '4.7']);
    }

    /**
     * Get form title with new classification
     */
    public static function getFormTitle(string $formCode): string
    {
        $mapping = self::getFormMapping();
        $classification = $mapping[$formCode] ?? 'Unknown';
        
        return "{$formCode} - {$classification}";
    }

    /**
     * Get category by form mapping
     */
    public static function getCategoryByForm(string $formCode): ?Category
    {
        return Category::where('form_mapping', $formCode)->first();
    }

    /**
     * Get categories by classification name
     */
    public static function getCategoriesByClassification(string $classificationName): \Illuminate\Database\Eloquent\Collection
    {
        return Category::where('name', $classificationName)->get();
    }
}
