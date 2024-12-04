<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(100)->afterCreating(function (Product $product) {
            $this->addImages($product);
        })->create();
    }

    private function addImages(Product $product): void
    {
        Image::factory(rand(1, 5))->create()->each(function (Image $image, int $index) use ($product) {
            $image->update([
                'imageable_id' => $product->id,
                'imageable_type' => $product::class,
                'position' => $index
            ]);
            $image->save();
        });
    }
}
