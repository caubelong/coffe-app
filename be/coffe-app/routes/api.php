<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\admin\RoleController;
use App\Http\Controllers\Api\admin\UserController;
use App\Http\Controllers\Api\admin\ToppingController;
use App\Http\Controllers\Api\admin\CategoryController;
use App\Http\Controllers\Api\admin\ProductController;
use App\Http\Controllers\Api\admin\PostController;
use App\Http\Controllers\Api\admin\AuthController;
use App\Http\Controllers\Api\user\ClientController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/auth/register', [AuthController::class, 'register']);
Route::group(['prefix'=>'admin','middleware'=>'auth:sanctum'],function (){
    Route::apiResource('roles',RoleController::class);
    Route::apiResource('users',UserController::class);
    Route::apiResource('toppings',ToppingController::class);
    Route::apiResource('categories',CategoryController::class);
    Route::apiResource('products',ProductController::class);
    Route::apiResource('posts',PostController::class);
});
Route::get('/user/menu',[ClientController::class,'getProductByCategory']);
Route::get('/user/menu/info/{product}',[ClientController::class,'getProductInfoById']);
Route::get('/user/menu/product-related/{productId}/{cate_id}',[ClientController::class,'getProductRelated']);
Route::get('user/menu/post-slider',[ClientController::class,'getPostSlider']);
Route::get('user/menu/post-detail/{post}',[ClientController::class,'getPostDetail']);
Route::get('user/menu/post-related/{post}',[ClientController::class,'getPostRelatedList']);
Route::get('user/menu/get-post-list',[ClientController::class,'getPostList']);
