<?php

use app\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->name('products.')->group(function () {
    Route::get('', [ProductController::class, 'index'])
        ->name('index');
    Route::get('{product}', [ProductController::class, 'show'])
        ->whereNumber(['product' => '[0-9]+'])
        ->name('show');
});
