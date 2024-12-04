<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productEntity = Product::query()->inRandomOrder()->first();
        $imgUrlPath = $this->getRandomImgPath();

        return [
            'imageable_id' => $productEntity->id,
            'imageable_type' => $productEntity::class,
            'position' => 1,
            'filename' => pathinfo($imgUrlPath, PATHINFO_FILENAME),
            'path' => $imgUrlPath,
            'mime_type' => Storage::disk('public')->mimeType($imgUrlPath)
        ];
    }

    private function getRandomImgPath(): ?string
    {
        $files = Storage::disk('public')->files('images');

        return empty($files) ? null : $files[array_rand($files)];
    }
}
