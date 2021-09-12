<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Api\ProductController;

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

Route::get('/hello', function (){
    return 'merhaba restful api';
});

/*Route::get('/users', function (){
    return User::factory()->count(10)->make();
});*/

//Route::apiResource('/products', 'Api\ProductController');
//Route::apiResource('/users', 'Api\UserController');

Route::get('/categories/custom', 'Api\CategoryController@custom');
Route::get('/products/custom', 'Api\ProductController@custom');
Route::get('/categories/report', 'Api\CategoryController@report');

Route::apiResources([
    'products' => 'Api\ProductController',
    'users' => 'Api\UserController',
    'categories' => 'Api\CategoryController'
]);
