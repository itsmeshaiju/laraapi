<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
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
//Public Route
//Route::resource('products',ProductController::class);
Route::post('register',[AuthController::class,'register']);
Route::get('products',[ProductController::class,'index']);
Route::get('products/{id}',[ProductController::class,'show']);
Route::get('products/search/{name}',[ProductController::class,'search']);

//Protected Routes
Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::post('products',[ProductController::class,'store']);
    Route::put('products/{id}',[ProductController::class,'update']);
    Route::delete('products/{id}',[ProductController::class,'destory']);
});

// Route::get('products',[ProductController::class,'index']);
// Route::post('products',[ProductController::class,'store']);
// Route::post('products',function(){
//     return Product::create([
//         'name'=>'Product Two',
//         'slug'=>'product-two',
//         'description'=>'This is product two',
//         'price'=>"80.95"
//     ]);
// });
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
