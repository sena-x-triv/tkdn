<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Material', 'code' => 'MAT'],
            ['name' => 'Pekerja', 'code' => 'PEK'],
            ['name' => 'Peralatan', 'code' => 'PER'],
            ['name' => 'Jasa', 'code' => 'JAS'],
        ];
        foreach ($data as $item) {
            Category::firstOrCreate(['code' => $item['code']], $item);
        }
    }
} 