<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('Welcome');
    return redirect()->route('category.show', ['slug'=>'books']);
});

Route::prefix('basics')->group(function(){

    Route::get('/json', function (){
       return ['message' => "Merhaba Laravel"];
    });

    Route::get('/hello-json', function (){
        return response(['message' => 'Laravel Öğreniyorum'], 200)
            ->header('Content-Type', 'application/json');
    });

    Route::get('/hello-laravel', function (){
        return response()->json(['message' => 'Laravel Öğreniyorum']);
        //header bilgisi application/json olarak otomatik verilir.
    });

    Route::get('/product/{id}', function ($id){
        return "Product Id :  $id";
    });

    Route::get('/product/{id}/{type}', function ($id, $type){
        return "Product Id :  $id, Type : $type";
    });

    Route::get('/category/{slug}', function ($slug){
        return "Category Slug : $slug";
    })->name('category.show');

});

//Route::get('/product/{id}/{type}', 'ProductController@show')->name('product.show');
//Route::resource('/products', 'ProductController');
