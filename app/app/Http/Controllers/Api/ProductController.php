<?php

namespace app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Products\IndexResource;
use App\Http\Resources\Api\Products\ShowResource;
use App\Models\Product;

class ProductController extends Controller
{
    // Usually I keep all logic into services & repositories and trigger them from controllers,
    // but due to small size of the task I think it's unnecessary.
    public function index()
    {
        $products = Product::all();
        $products->load([
            'category:id,title',
            'images' => fn($q) => $q
                ->orderBy('position')
                ->select(['id', 'imageable_id', 'imageable_type', 'path'])
                ->first(),
        ]);

        return new IndexResource(Product::all());
    }

    public function show(Product $product): ShowResource
    {
        $product->load([
            'category' => fn($q) => $q->with('parentCategory:id,title'),
            'images' => fn($q) => $q
                ->orderBy('position')
                ->select(['id', 'imageable_id', 'imageable_type', 'position', 'path']),
        ]);

        return new ShowResource($product);
    }
}
