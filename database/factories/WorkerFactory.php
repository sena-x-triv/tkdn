<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'WK-'.$this->faker->numberBetween(1, 999),
            'name' => $this->faker->name(),
            'unit' => $this->faker->randomElement(['hari', 'jam', 'bulan']),
            'category_id' => Category::where('name', 'Pekerja')->first()?->id ?? Category::first()?->id,
            'price' => $this->faker->numberBetween(100000, 500000),
            'tkdn' => $this->faker->randomElement([0, 1]),
            'location' => $this->faker->city(),
        ];
    }
}
