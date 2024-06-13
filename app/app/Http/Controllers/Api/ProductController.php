<?php

namespace app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Products\IndexResource;
use App\Http\Resources\Api\Products\ShowResource;
use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    // Usually I keep all logic into services & repositories and trigger them from controllers,
    // but due to small size of the task I think it's unnecessary.
    //
    // I could also use the Request class for pagination functional,
    // but the pagination wasn't described in the task's goals.
    public function index(): IndexResource
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

    // we can use soft binding instead of manual getting for a model entity.
    public function show(int $id): ShowResource
    {
        try {
            $product = Product::query()->findOrFail($id);
        } catch (Exception $e) {
            throw new ModelNotFoundException();
        }

        $product->with([
            'category' => fn($q) => $q->with('parentCategory:id,title'),
            'images' => fn($q) => $q
                ->orderBy('position')
                ->select(['id', 'imageable_id', 'imageable_type', 'position', 'path']),
        ]);

        return new ShowResource($product);
    }
}
