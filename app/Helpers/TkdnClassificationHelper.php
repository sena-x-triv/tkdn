<?php

namespace App\Helpers;

class TkdnClassificationHelper
{
    /**
     * Mapping TKDN Classification dengan kode unik
     */
    public const CLASSIFICATIONS = [
        1 => [
            'code' => 1,
            'name' => 'Overhead & Manajemen',
            'description' => 'Overhead dan manajemen proyek',
            'form_numbers' => ['3.1', '4.3'],
            'project_types' => ['tkdn_jasa', 'tkdn_barang_jasa'],
        ],
        2 => [
            'code' => 2,
            'name' => 'Alat Kerja / Fasilitas',
            'description' => 'Alat kerja dan fasilitas pendukung',
            'form_numbers' => ['3.2', '4.4'],
            'project_types' => ['tkdn_jasa', 'tkdn_barang_jasa'],
        ],
        3 => [
            'code' => 3,
            'name' => 'Konstruksi & Fabrikasi',
            'description' => 'Konstruksi dan fabrikasi',
            'form_numbers' => ['3.3', '4.5'],
            'project_types' => ['tkdn_jasa', 'tkdn_barang_jasa'],
        ],
        4 => [
            'code' => 4,
            'name' => 'Peralatan (Jasa Umum)',
            'description' => 'Peralatan untuk jasa umum',
            'form_numbers' => ['3.4', '4.6'],
            'project_types' => ['tkdn_jasa', 'tkdn_barang_jasa'],
        ],
        5 => [
            'code' => 5,
            'name' => 'Material (Bahan Baku)',
            'description' => 'Material dan bahan baku',
            'form_numbers' => ['4.1'],
            'project_types' => ['tkdn_barang_jasa'],
        ],
        6 => [
            'code' => 6,
            'name' => 'Peralatan (Barang Jadi)',
            'description' => 'Peralatan barang jadi',
            'form_numbers' => ['4.2'],
            'project_types' => ['tkdn_barang_jasa'],
        ],
    ];

    /**
     * Get all classifications
     */
    public static function getAllClassifications(): array
    {
        return self::CLASSIFICATIONS;
    }

    /**
     * Get classification by code
     */
    public static function getClassificationByCode(string $code): ?array
    {
        return self::CLASSIFICATIONS[$code] ?? null;
    }

    /**
     * Get classification by name
     */
    public static function getClassificationByName(string $name): ?array
    {
        foreach (self::CLASSIFICATIONS as $classification) {
            if ($classification['name'] === $name) {
                return $classification;
            }
        }

        return null;
    }

    /**
     * Get classification code by name
     */
    public static function getCodeByName(string $name): ?string
    {
        $classification = self::getClassificationByName($name);

        return $classification ? $classification['code'] : null;
    }

    /**
     * Get classification name by code
     */
    public static function getNameByCode(string $code): ?string
    {
        $classification = self::getClassificationByCode($code);

        return $classification ? $classification['name'] : null;
    }

    /**
     * Get form numbers for classification and project type
     */
    public static function getFormNumbersForClassification(string $classificationName, ?string $projectType = null): array
    {
        $classification = self::getClassificationByName($classificationName);
        if (! $classification) {
            return [];
        }

        if ($projectType === null) {
            return $classification['form_numbers'];
        }

        // Check if classification is valid for this project type
        if (! in_array($projectType, $classification['project_types'])) {
            return [];
        }

        // Filter form numbers based on project type
        $filteredFormNumbers = [];
        foreach ($classification['form_numbers'] as $formNumber) {
            // Map form numbers to project types
            if (($formNumber === '3.1' && $projectType === 'tkdn_jasa') ||
                ($formNumber === '3.2' && $projectType === 'tkdn_jasa') ||
                ($formNumber === '3.3' && $projectType === 'tkdn_jasa') ||
                ($formNumber === '3.4' && $projectType === 'tkdn_jasa') ||
                ($formNumber === '4.1' && $projectType === 'tkdn_barang_jasa') ||
                ($formNumber === '4.2' && $projectType === 'tkdn_barang_jasa') ||
                ($formNumber === '4.3' && $projectType === 'tkdn_barang_jasa') ||
                ($formNumber === '4.4' && $projectType === 'tkdn_barang_jasa') ||
                ($formNumber === '4.5' && $projectType === 'tkdn_barang_jasa') ||
                ($formNumber === '4.6' && $projectType === 'tkdn_barang_jasa')) {
                $filteredFormNumbers[] = $formNumber;
            }
        }

        return $filteredFormNumbers;
    }

    /**
     * Get classifications for project type
     */
    public static function getClassificationsForProjectType(string $projectType): array
    {
        $classifications = [];
        foreach (self::CLASSIFICATIONS as $classification) {
            if (in_array($projectType, $classification['project_types'])) {
                $classifications[] = $classification['name'];
            }
        }

        return $classifications;
    }

    /**
     * Get classifications for form number
     */
    public static function getClassificationsForFormNumber(string $formNumber, ?string $projectType = null): array
    {
        $classifications = [];
        foreach (self::CLASSIFICATIONS as $classification) {
            if (in_array($formNumber, $classification['form_numbers'])) {
                if ($projectType === null || in_array($projectType, $classification['project_types'])) {
                    $classifications[] = $classification['name'];
                }
            }
        }

        return $classifications;
    }

    /**
     * Check if classification is valid for project type
     */
    public static function isValidForProjectType(string $classificationName, string $projectType): bool
    {
        $classification = self::getClassificationByName($classificationName);
        if (! $classification) {
            return false;
        }

        return in_array($projectType, $classification['project_types']);
    }

    /**
     * Get all classification codes
     */
    public static function getAllCodes(): array
    {
        return array_keys(self::CLASSIFICATIONS);
    }

    /**
     * Get all classification names
     */
    public static function getAllNames(): array
    {
        return array_column(self::CLASSIFICATIONS, 'name');
    }

    /**
     * Get classification options for select/dropdown
     */
    public static function getSelectOptions(): array
    {
        $options = [];
        foreach (self::CLASSIFICATIONS as $code => $classification) {
            $options[$code] = $classification['name'];
        }

        return $options;
    }

    /**
     * Get classification options with descriptions for select/dropdown
     */
    public static function getSelectOptionsWithDescription(): array
    {
        $options = [];
        foreach (self::CLASSIFICATIONS as $code => $classification) {
            $options[$code] = [
                'name' => $classification['name'],
                'description' => $classification['description'],
                'code' => $classification['code'],
            ];
        }

        return $options;
    }

    /**
     * Get project type mapping for classification
     */
    public static function getProjectTypeMapping(): array
    {
        $mapping = [];
        foreach (self::CLASSIFICATIONS as $code => $classification) {
            $mapping[$classification['name']] = $classification['project_types'];
        }

        return $mapping;
    }

    /**
     * Get form number mapping for classification
     */
    public static function getFormNumberMapping(): array
    {
        $mapping = [];
        foreach (self::CLASSIFICATIONS as $code => $classification) {
            $mapping[$classification['name']] = $classification['form_numbers'];
        }

        return $mapping;
    }

    /**
     * Get classification by form number
     */
    public static function getClassificationByFormNumber(string $formNumber): ?array
    {
        foreach (self::CLASSIFICATIONS as $code => $classification) {
            if (in_array($formNumber, $classification['form_numbers'])) {
                return $classification;
            }
        }

        return null;
    }

    /**
     * Validate classification code
     */
    public static function isValidCode(string $code): bool
    {
        return array_key_exists($code, self::CLASSIFICATIONS);
    }

    /**
     * Validate classification name
     */
    public static function isValidName(string $name): bool
    {
        return self::getClassificationByName($name) !== null;
    }

    /**
     * Get classification statistics
     */
    public static function getStatistics(): array
    {
        $stats = [
            'total_classifications' => count(self::CLASSIFICATIONS),
            'tkdn_jasa_only' => 0,
            'tkdn_barang_jasa_only' => 0,
            'both_project_types' => 0,
        ];

        foreach (self::CLASSIFICATIONS as $classification) {
            $projectTypes = $classification['project_types'];
            if (count($projectTypes) === 1) {
                if ($projectTypes[0] === 'tkdn_jasa') {
                    $stats['tkdn_jasa_only']++;
                } elseif ($projectTypes[0] === 'tkdn_barang_jasa') {
                    $stats['tkdn_barang_jasa_only']++;
                }
            } else {
                $stats['both_project_types']++;
            }
        }

        return $stats;
    }
}
