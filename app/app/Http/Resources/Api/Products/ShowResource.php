<?php

namespace App\Http\Resources\Api\Products;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'categoryPath' => $this->getFullCategoryPath($this->category),
            'name' => $this->title,
            'price' => $this->price,
            'priceDiscount' => $this->price_discount < $this->price ? $this->price_discount : 0,
            'isEnding' => $this->quantity > 0 && $this->quantity < 10,
            'images' => $this->getImages($this->images)
        ];
    }

    private function getFullCategoryPath($category): string
    {
        return $category?->parentCategory ? "{$category->parentCategory->title} -> {$category->title}" : $category->title;
    }

    private function getImages(Collection $imgCollection): Collection
    {
        return $imgCollection->map(fn(Image $img) => [
            'position' => $img->position,
            'src' => $img->src
        ]);
    }
}
