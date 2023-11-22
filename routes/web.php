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
use App\Http\Controllers\OthersController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SoldController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\CreateDiscController;
use App\Http\Controllers\MahallahEquipmentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\SellerProfileController;
use Illuminate\Contracts\Cache\Store;

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

Route::get('/community', function () {
    return view('community',[
        "title" => "Community Forum",
    ]);
});



Route::get('/feedback', function () {
    return view('feedback',[
        "title" => "Feedback",
    ]);
});

//Route::get('/order', function () {
//    return view('order',[
//        "title" => "Create Discussion",
//    ]);
//});

Route::get('/createdisc', function () {
    return view('createdisc',[
        "title" => "Create Discussion",
    ]);
});

Route::resource('/createdisc', CreateDiscController::class)->middleware('auth');


Route::get('/agreebuy', function () {
    return view('afterbuy',[
        "title" => "Confirm Order",
    ]);
})->name('agreebuy');;


Route::get('/product/search',[ProductController::class,'search']);





//Route::resource('/productafterbuy',SoldController::class)->middleware('auth');
//Route::get('/productafterbuy/{id}','SoldController@show')->name('buy.show')->middleware('auth');

Route::resource('/myorder',MyOrderController::class)->middleware('auth');

//Route::get('/viewproduct', function () {
//   return view('products.viewproduct',[
//       "title" => "View Product",
//  ]);
//});

Route::get('/sellerprofile',[SellerProfileController::class,'index']);
Route::get('/sellerprofile/{id}',[SellerProfileController::class,'show'])->name('sellerprofile.show');


Route::resource('/discussion', DiscussionController::class)->middleware('auth');
Route::get('/discussion/{discussion}',[DiscussionController::class,'show']);

//Route::get('/products/{id}', 'ProductController@show')->name('product.show');

//Route::get('/products/{$product->id}', [ProductController::class,'show']);
Route::resource('/products',ProductController::class)->middleware('auth');

Route::resource('/chat',MessageController::class)->middleware('auth');

Route::resource('/buy',OrderController::class)->middleware('auth');
Route::get('/buy/{id}', 'OrderController@show')->name('buy.show')->middleware('auth');
Route::post('/buy/{id}/{totalPrice}', [OrderController::class, 'store'])->name('buy.store')->middleware('auth');
//Route::post('/order', 'OrderController@store')->name('order.store');
//Route::post('/order',[ OrderController::class,'store'])->middleware('auth');



Route::resource('/cart',CartController::class)->middleware('auth');
//Route::get('/cart/{id}', 'CartController@show')->name('cart.show')->middleware('auth');


Route::get('/fashion',[FashionController::class,'index']);
Route::get('/books',[BookController::class,'index']);
Route::get('/electronics',[ElectronicController::class,'index']);
Route::get('/cosmetics',[CosmeticController::class,'index']);
Route::get('/mahallah',[MahallahEquipmentController::class,'index']);
Route::get('/others',[OthersController::class,'index']);


Route::get('/login', [LoginController:: class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController:: class, 'authenticate'] );
Route::post('/logout', [LoginController:: class, 'logout'] );

Route::get('/register', [RegisterController:: class, 'index'] )->middleware('guest');
Route::post('/register', [RegisterController:: class, 'store'] );

Route::get('homepage',[HomePageController::class,'index'])->middleware('auth')->name('homepage');


//Route::get('/sell', function(){
//    return view('sell.index', [
//        "title" => "Sell",
//    ]);
//})->middleware('auth');

Route::resource('/sell', SellController::class)->middleware('auth');
//Route::put('/sell', [SellController::class, 'update'])->middleware('auth');
//Route::put('/sell/{{$product->id}}/edit', 'SellController@update')->name('sell.update');
Route::post('image/upload/store',[ SellController::class,'store'])->middleware('auth');
//Route::get('/sell/show/{id}','SellController@show')->middleware('auth');
Route::get('/get-subcategories/{categoryId}', 'SellController@getSubcategoriesAjax');


Route::resource('/profile',ProfileController::class)->middleware('auth');

Route::resource('/settings',UserProfileController::class)->middleware('auth');
