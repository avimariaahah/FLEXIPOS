<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('user')->group(function () {});

//Login Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// User Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});


// ProductCategory Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/productcategories', [ProductCategoryController::class, 'index']);
    Route::post('/productcategories', [ProductCategoryController::class, 'store']);
    Route::get('/productcategories/{productCategoryId}', [ProductCategoryController::class, 'show']);
    Route::put('/productcategories/{productCategoryId}', [ProductCategoryController::class, 'update']);
    Route::delete('/productcategories/{productCategoryId}', [ProductCategoryController::class, 'destroy']);
});

//Products Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{productId}', [ProductController::class, 'show']);
    Route::put('/products/{productId}', [ProductController::class, 'update']);
    Route::delete('/products/{productId}', [ProductController::class, 'destroy']);
});

//Suppliers Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::post('/suppliers', [SupplierController::class, 'store']);
    Route::get('/suppliers/{supplierID}', [SupplierController::class, 'show']);
    Route::put('/suppliers/{supplierID}', [SupplierController::class, 'update']);
    Route::delete('/suppliers/{supplierID}', [SupplierController::class, 'destroy']);
});

//Customers Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers/{customerID}', [CustomerController::class, 'show']);
    Route::put('/customers/{customerID}', [CustomerController::class, 'update']);
    Route::delete('/customers/{customerID}', [CustomerController::class, 'destroy']);
});
