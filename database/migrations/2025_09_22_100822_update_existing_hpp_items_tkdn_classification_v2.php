<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing HPP items with proper TKDN classification codes
        $hppItems = DB::table('hpp_items')
            ->whereNull('tkdn_classification')
            ->orWhere('tkdn_classification', '')
            ->get();

        foreach ($hppItems as $hppItem) {
            // Get estimation item to determine classification
            $estimationItem = DB::table('estimation_items')
                ->where('id', $hppItem->estimation_item_id)
                ->first();

            if (! $estimationItem) {
                continue;
            }

            $classificationCode = null;

            // Get classification from master data based on category
            switch ($estimationItem->category) {
                case 'worker':
                    $worker = DB::table('workers')
                        ->where('id', $estimationItem->reference_id)
                        ->first();
                    if ($worker && $worker->classification_tkdn) {
                        $classificationCode = $worker->classification_tkdn;
                    }
                    break;

                case 'material':
                    $material = DB::table('material')
                        ->where('id', $estimationItem->reference_id)
                        ->first();
                    if ($material && $material->classification_tkdn) {
                        $classificationCode = $material->classification_tkdn;
                    }
                    break;

                case 'equipment':
                    $equipment = DB::table('equipment')
                        ->where('id', $estimationItem->reference_id)
                        ->first();
                    if ($equipment && $equipment->classification_tkdn) {
                        $classificationCode = $equipment->classification_tkdn;
                    }
                    break;
            }

            // Update HPP item with classification code
            if ($classificationCode) {
                DB::table('hpp_items')
                    ->where('id', $hppItem->id)
                    ->update(['tkdn_classification' => $classificationCode]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Set all tkdn_classification to null for rollback
        DB::table('hpp_items')
            ->update(['tkdn_classification' => null]);
    }
};
