<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            ['name' => 'Gedung Perkantoran 5 Lantai', 'description' => 'Konstruksi gedung perkantoran modern di Jakarta Pusat'],
            ['name' => 'Rumah Sakit Umum', 'description' => 'Pembangunan rumah sakit 200 tempat tidur di Bandung'],
            ['name' => 'Mall Shopping Center', 'description' => 'Pusat perbelanjaan 3 lantai dengan area parkir'],
            ['name' => 'Apartemen Premium', 'description' => 'Tower apartemen 20 lantai dengan fasilitas lengkap'],
            ['name' => 'Jembatan Layang', 'description' => 'Konstruksi jembatan layang 2 km di Surabaya'],
            ['name' => 'Bandara Internasional', 'description' => 'Terminal bandara baru dengan kapasitas 10 juta penumpang'],
            ['name' => 'Hotel Bintang 5', 'description' => 'Hotel mewah dengan 300 kamar dan convention center'],
            ['name' => 'Sekolah Menengah Atas', 'description' => 'Gedung sekolah 3 lantai dengan laboratorium'],
            ['name' => 'Pabrik Manufaktur', 'description' => 'Pabrik dengan area produksi 5000 m2'],
            ['name' => 'Gedung Parkir Bertingkat', 'description' => 'Parking building 8 lantai dengan 1000 slot'],
            ['name' => 'Masjid Agung', 'description' => 'Masjid dengan kapasitas 5000 jamaah'],
            ['name' => 'Stasiun Kereta Api', 'description' => 'Stasiun modern dengan 4 peron'],
            ['name' => 'Gedung Pemerintahan', 'description' => 'Kantor pemerintah daerah dengan 10 lantai'],
            ['name' => 'Universitas Kampus', 'description' => 'Gedung kuliah dengan 15 ruang kelas'],
            ['name' => 'Pusat Olahraga', 'description' => 'GOR dengan kapasitas 5000 penonton'],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
 