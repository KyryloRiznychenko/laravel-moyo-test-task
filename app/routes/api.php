<?php

use app\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

// I can use here translates, but I don't see sens do it for one sting
Route::fallback(fn() => response()->json(['message' => 'invalid route'], Response::HTTP_NOT_FOUND));

Route::prefix('products')->name('products.')->group(function () {
    Route::get('', [ProductController::class, 'index'])
        ->name('index');
    Route::get('{id}', [ProductController::class, 'show'])
        ->whereNumber(['id' => '[0-9]+'])
        ->name('show');
});
