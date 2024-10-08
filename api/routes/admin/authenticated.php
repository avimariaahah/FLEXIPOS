<?php

use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\BillController;
use App\Http\Controllers\Api\Admin\BillDetailController;
use App\Http\Controllers\Api\Admin\CustomerController;
use App\Http\Controllers\Api\Admin\EmployeeController;
use App\Http\Controllers\Api\Admin\ProductCategoryController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'users' => UserController::class,
        'products' => ProductController::class,
        'product_categories' => ProductCategoryController::class,
        'suppliers' => SupplierController::class,
        'customers' => CustomerController::class,
        'employees' => EmployeeController::class,
        'bills' => BillController::class,
        'billdetails' => BillDetailController::class,
    ]);

    Route::apiResource('admin', AdminController::class)->except(['store']);

    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'unauthenticate']);
    });
});
