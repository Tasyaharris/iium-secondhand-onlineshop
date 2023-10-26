<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainpageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FashionController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ElectronicController;
use App\Http\Controllers\CosmeticController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [MainpageController:: class, 'index']);

Route::get('/homepage', [MainpageController:: class, 'index']);



Route::get('/books', function () {
    return view('books',[
        "title" => "Books",
    ]);
});

Route::get('/electronics', function () {
    return view('electronics',[
        "title" => "Electronics",
    ]);
});

Route::get('/cosmetics', function () {
    return view('cosmetics',[
        "title" => "Cosmetics",
    ]);
});

Route::get('/others', function () {
    return view('others',[
        "title" => "Others",
    ]);
});


Route::get('/cond_details', function () {
    return view('cond_details',[
        "title" => "Condition Details",
    ]);
});

//Route::get('/viewproduct', function () {
//   return view('products.viewproduct',[
//       "title" => "View Product",
//  ]);
//});


//Route::get('/products/{id}', 'ProductController@show')->name('product.show');

//Route::get('/products/{$product->id}', [ProductController::class,'show']);
Route::resource('/products',ProductController::class)->middleware('auth');

Route::resource('/chat',MessageController::class)->middleware('auth');
Route::get('/chat/user/{user}', 'MessageController@showUserDetails')->name('chat.showUserDetails');



Route::get('/fashion',[FashionController::class,'index'])->middleware('auth');
Route::get('/books',[BookController::class,'index'])->middleware('auth');
Route::get('/electronics',[ElectronicController::class,'index'])->middleware('auth');
Route::get('/cosmetics',[CosmeticController::class,'index'])->middleware('auth');


Route::get('/login', [LoginController:: class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController:: class, 'authenticate'] );
Route::post('/logout', [LoginController:: class, 'logout'] );

Route::get('/register', [RegisterController:: class, 'index'] )->middleware('guest');
Route::post('/register', [RegisterController:: class, 'store'] );

Route::get('homepage',[HomePageController::class,'index'])->middleware('auth');

//Route::get('/sell', function(){
//    return view('sell.index', [
//        "title" => "Sell",
//    ]);
//})->middleware('auth');

Route::resource('/sell',SellController::class)->middleware('auth');
//Route::put('/sell/{sell}', 'SellController@update')->name('sell.update');

Route::resource('/profile',ProfileController::class)->middleware('auth');