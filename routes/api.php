<?php

use App\Http\Controllers\Api\ConfigController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\WatchesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('vehicle_info/{api_key}/{reg_number}',[ConfigController::class,'getVehicleInformationFromRegNo']);

Route::post('find-watch',[WatchesController::class,'findWatch']);
Route::post('sell-watch',[WatchesController::class,'sellWatch']);
Route::post('consign-watch',[WatchesController::class,'consignWatch']);

Route::get('new-arrivals',[WatchesController::class,'newArrivals']);
// config apis
Route::get('brands',[ConfigController::class,'getBrands']);
Route::get('categories',[ConfigController::class,'getCategories']);
Route::get('get-generic-data',[ConfigController::class,'getGenericData']);


// products
Route::post('products',[ProductController::class,'products']);
Route::post('search_products',[ProductController::class,'searchProducts']);
Route::get('dashboard',[ProductController::class,'dashboard']);
Route::post('get-product-detail',[ProductController::class,'getProductDetail']);

Route::post('test-image',[WatchesController::class,'testImageUpoad']);