<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();

        if ($projects->isEmpty()) {
            $this->command->info('Tidak ada proyek yang tersedia. Silakan jalankan ProjectSeeder terlebih dahulu.');
            return;
        }

        $project = $projects->first();

        // Jasa 1: Manajemen Proyek
        $service1 = Service::create([
            'project_id' => $project->id,
            'service_name' => 'Manajemen Proyek dan Perekayasaan',
            'service_type' => Service::TYPE_PROJECT,
            'provider_name' => 'PT Konstruksi Maju',
            'provider_address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            'user_name' => 'PT Pembangunan Indonesia',
            'document_number' => 'DOC-2024-001',
            'status' => 'approved',
        ]);

        // Item untuk jasa 1
        ServiceItem::create([
            'service_id' => $service1->id,
            'item_number' => 1,
            'description' => 'Overhead management',
            'qualification' => 'S1 Teknik Sipil',
            'nationality' => 'WNI',
            'tkdn_percentage' => 100,
            'quantity' => 1,
            'duration' => 1.00,
            'duration_unit' => 'Is',
            'wage' => 103522080,
        ]);

        ServiceItem::create([
            'service_id' => $service1->id,
            'item_number' => 2,
            'description' => 'Management',
            'qualification' => 'S1 Manajemen',
            'nationality' => 'WNI',
            'tkdn_percentage' => 100,
            'quantity' => 1,
            'duration' => 1.00,
            'duration_unit' => 'Is',
            'wage' => 155283120,
        ]);

        // Hitung total
        $service1->calculateTotals();

        // Jasa 2: Konsultasi Teknis
        $service2 = Service::create([
            'project_id' => $project->id,
            'service_name' => 'Konsultasi Teknis dan Desain',
            'service_type' => Service::TYPE_PROJECT,
            'provider_name' => 'PT Konsultan Teknik',
            'provider_address' => 'Jl. Thamrin No. 45, Jakarta Pusat',
            'user_name' => 'PT Infrastruktur Nasional',
            'document_number' => 'DOC-2024-002',
            'status' => 'submitted',
        ]);

        // Item untuk jasa 2
        ServiceItem::create([
            'service_id' => $service2->id,
            'item_number' => 1,
            'description' => 'Konsultan Teknik Senior',
            'qualification' => 'S2 Teknik Sipil',
            'nationality' => 'WNI',
            'tkdn_percentage' => 100,
            'quantity' => 2,
            'duration' => 6.00,
            'duration_unit' => 'Bl',
            'wage' => 25000000,
        ]);

        ServiceItem::create([
            'service_id' => $service2->id,
            'item_number' => 2,
            'description' => 'Konsultan Desain',
            'qualification' => 'S1 Arsitektur',
            'nationality' => 'WNA',
            'tkdn_percentage' => 0,
            'quantity' => 1,
            'duration' => 3.00,
            'duration_unit' => 'Bl',
            'wage' => 35000000,
        ]);

        // Hitung total
        $service2->calculateTotals();

        // Jasa 3: Pengawasan Konstruksi
        $service3 = Service::create([
            'project_id' => $project->id,
            'service_name' => 'Pengawasan Konstruksi',
            'service_type' => Service::TYPE_CONSTRUCTION,
            'provider_name' => 'PT Supervisi Konstruksi',
            'provider_address' => 'Jl. Gatot Subroto No. 67, Jakarta Selatan',
            'user_name' => 'PT Pembangunan Indonesia',
            'document_number' => 'DOC-2024-003',
            'status' => 'draft',
        ]);

        // Item untuk jasa 3
        ServiceItem::create([
            'service_id' => $service3->id,
            'item_number' => 1,
            'description' => 'Pengawas Lapangan',
            'qualification' => 'S1 Teknik Sipil',
            'nationality' => 'WNI',
            'tkdn_percentage' => 100,
            'quantity' => 3,
            'duration' => 12.00,
            'duration_unit' => 'Bl',
            'wage' => 15000000,
        ]);

        ServiceItem::create([
            'service_id' => $service3->id,
            'item_number' => 2,
            'description' => 'Kepala Pengawas',
            'qualification' => 'S1 Teknik Sipil',
            'nationality' => 'WNI',
            'tkdn_percentage' => 100,
            'quantity' => 1,
            'duration' => 12.00,
            'duration_unit' => 'Bl',
            'wage' => 25000000,
        ]);

        ServiceItem::create([
            'service_id' => $service3->id,
            'item_number' => 3,
            'description' => 'Konsultan QA/QC',
            'qualification' => 'S1 Teknik Sipil',
            'nationality' => 'WNA',
            'tkdn_percentage' => 30,
            'quantity' => 1,
            'duration' => 6.00,
            'duration_unit' => 'Bl',
            'wage' => 40000000,
        ]);

        // Hitung total
        $service3->calculateTotals();

        // Jasa 4: Alat Kerja
        $service4 = Service::create([
            'project_id' => $project->id,
            'service_name' => 'Sewa Alat Kerja dan Peralatan',
            'service_type' => Service::TYPE_EQUIPMENT,
            'provider_name' => 'PT Sewa Alat',
            'provider_address' => 'Jl. Industri No. 89, Jakarta Utara',
            'user_name' => 'PT Pembangunan Indonesia',
            'document_number' => 'DOC-2024-004',
            'status' => 'approved',
        ]);

        // Item untuk jasa 4
        ServiceItem::create([
            'service_id' => $service4->id,
            'item_number' => 1,
            'description' => 'Sewa Excavator',
            'qualification' => 'Operator Berpengalaman',
            'nationality' => 'WNI',
            'tkdn_percentage' => 100,
            'quantity' => 2,
            'duration' => 8.00,
            'duration_unit' => 'Bl',
            'wage' => 50000000,
        ]);

        ServiceItem::create([
            'service_id' => $service4->id,
            'item_number' => 2,
            'description' => 'Sewa Crane',
            'qualification' => 'Operator Berpengalaman',
            'nationality' => 'WNI',
            'tkdn_percentage' => 100,
            'quantity' => 1,
            'duration' => 6.00,
            'duration_unit' => 'Bl',
            'wage' => 35000000,
        ]);

        ServiceItem::create([
            'service_id' => $service4->id,
            'item_number' => 3,
            'description' => 'Sewa Generator',
            'qualification' => 'Teknisi',
            'nationality' => 'WNA',
            'tkdn_percentage' => 0,
            'quantity' => 1,
            'duration' => 12.00,
            'duration_unit' => 'Bl',
            'wage' => 20000000,
        ]);

        // Hitung total
        $service4->calculateTotals();

        $this->command->info('ServiceSeeder berhasil dijalankan!');
    }
} 