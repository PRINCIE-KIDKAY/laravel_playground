<?php

use App\Http\Controllers\EloquentproductController;
use App\Http\Controllers\product_with_raw_sqlController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;




Route::group([

    'middleware' => 'api',
    'prefix' => '/v1/products'

], function ($router) {

    // Accounts
    Route::get('/all_products', [productController::class,'index']);
    Route::get('/products_table', [productController::class,'show_table']);
    Route::get('/get_product', [productController::class,'show']);
    Route::post('/products',  [productController::class,'store']);
    Route::put('/update_product',  [productController::class,'update']);
    Route::delete('/delete_product', [productController::class,'destroy']);

});


Route::group([

    'middleware' => 'api',
    'prefix' => '/v1/eloquent_products'

], function ($router) {

    // Accounts
//    Route::get('/all_products', [EloquentproductController::class,'index']);
    Route::post('/products_table', [EloquentproductController::class,'table']);
    Route::get('/get_product/{id}', [EloquentproductController::class,'show']);
    Route::post('/new_product',  [EloquentproductController::class,'store']);
    Route::put('/update_product',  [EloquentproductController::class,'update']);
    Route::delete('/delete_product', [EloquentproductController::class,'destroy']);

});


Route::group([

    'middleware' => 'api',
    'prefix' => '/v1/raw_sql_products'

], function ($router) {

    // Accounts
//    Route::get('/all_products', [EloquentproductController::class,'index']);
    Route::post('/products_table', [product_with_raw_sqlController::class,'table']);
    Route::get('/get_product/{id}', [product_with_raw_sqlController::class,'show']);
    Route::post('/new_product',  [product_with_raw_sqlController::class,'store']);
    Route::put('/update_product',  [product_with_raw_sqlController::class,'update']);
    Route::delete('/delete_product', [product_with_raw_sqlController::class,'destroy']);

});
