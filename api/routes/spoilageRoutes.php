<?php


use App\Http\Controllers\Api\Admin\SpoilageDetailController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    // Routes for Spoilage Details
    Route::post('spoilages/{spoilage}/details', [SpoilageDetailController::class, 'store']);
    Route::put('spoilages/details/{spoilageDetail}', [SpoilageDetailController::class, 'update']);
    Route::delete('spoilages/details/{spoilageDetail}', [SpoilageDetailController::class, 'destroy']);
});
