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
        $faker = \Faker\Factory::create('id_ID');
        $statusList = ['draft', 'on_progress', 'completed'];
        $projects = [
            ['name' => 'Gedung Perkantoran 5 Lantai', 'description' => 'Konstruksi gedung perkantoran modern di Jakarta Pusat', 'company' => 'PT Pembangunan Jaya'],
            ['name' => 'Rumah Sakit Umum', 'description' => 'Pembangunan rumah sakit 200 tempat tidur di Bandung', 'company' => 'PT Kesehatan Indonesia'],
            ['name' => 'Mall Shopping Center', 'description' => 'Pusat perbelanjaan 3 lantai dengan area parkir', 'company' => 'PT Retail Development'],
            ['name' => 'Apartemen Premium', 'description' => 'Tower apartemen 20 lantai dengan fasilitas lengkap', 'company' => 'PT Property Sejahtera'],
            ['name' => 'Jembatan Layang', 'description' => 'Konstruksi jembatan layang 2 km di Surabaya', 'company' => 'PT Infrastruktur Maju'],
            ['name' => 'Bandara Internasional', 'description' => 'Terminal bandara baru dengan kapasitas 10 juta penumpang', 'company' => 'PT Aviation Indonesia'],
            ['name' => 'Hotel Bintang 5', 'description' => 'Hotel mewah dengan 300 kamar dan convention center', 'company' => 'PT Hospitality Group'],
            ['name' => 'Sekolah Menengah Atas', 'description' => 'Gedung sekolah 3 lantai dengan laboratorium', 'company' => 'PT Pendidikan Bangsa'],
            ['name' => 'Pabrik Manufaktur', 'description' => 'Pabrik dengan area produksi 5000 m2', 'company' => 'PT Industri Maju'],
            ['name' => 'Gedung Parkir Bertingkat', 'description' => 'Parking building 8 lantai dengan 1000 slot', 'company' => 'PT Parking Solution'],
            ['name' => 'Masjid Agung', 'description' => 'Masjid dengan kapasitas 5000 jamaah', 'company' => 'PT Wakaf Indonesia'],
            ['name' => 'Stasiun Kereta Api', 'description' => 'Stasiun modern dengan 4 peron', 'company' => 'PT Kereta Api Indonesia'],
            ['name' => 'Gedung Pemerintahan', 'description' => 'Kantor pemerintah daerah dengan 10 lantai', 'company' => 'PT Pembangunan Negara'],
            ['name' => 'Universitas Kampus', 'description' => 'Gedung kuliah dengan 15 ruang kelas', 'company' => 'PT Pendidikan Tinggi'],
            ['name' => 'Pusat Olahraga', 'description' => 'GOR dengan kapasitas 5000 penonton', 'company' => 'PT Olahraga Nasional'],
        ];

        foreach ($projects as $project) {
            $start = $faker->dateTimeBetween('-2 years', 'now');
            $end = (clone $start)->modify('+'.rand(30, 365).' days');
            Project::create([
                'name' => $project['name'],
                'description' => $project['description'],
                'company' => $project['company'],
                'status' => $faker->randomElement($statusList),
                'start_date' => $start->format('Y-m-d'),
                'end_date' => $end->format('Y-m-d'),
                'location' => $faker->city,
            ]);
        }
    }
}
 