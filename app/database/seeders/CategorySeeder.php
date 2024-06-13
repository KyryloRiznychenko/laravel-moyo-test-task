<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $isMainCategory = $i < 4;
            $categoryTitle = sprintf('%s Category, entity_id: %d', $isMainCategory ? 'Main' : 'Sub', $i);

            if (Category::query()->whereTitle($categoryTitle)->doesntExist()) {
                Category::factory()->create([
                    'title' => $categoryTitle,
                    'parent_id' => !$isMainCategory ? Category::query()->inRandomOrder()->first()->id : null,
                ]);
            }
        }
    }
}
