<?php

namespace App\Http\Resources\Api\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->resource->map(function (Product $product) {
            return [
                'id' => $product->id,
                'categoryName' => $product->category->title,
                'name' => $product->title,
                'price' => $product->price_discount < $product->price ? $product->price_discount : $product->price,
                'inStock' => $product->quantity > 0 && ($product->price || $product->price_discount),
                'src' => $product->images->first()->src,
            ];

        })->toArray();
    }
}
