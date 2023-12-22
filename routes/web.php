<?php

use App\Events\HelloEvent;
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
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProcessOrderController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChannelAuthorizationController;

use Chatify\Http\Controllers\Api\MessagesController;
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

Route::get('/homepage', [MainpageController:: class, 'index'])->middleware('auth');



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



//Route::get('/feedback', function () {
//    return view('feedback',[
//        "title" => "Feedback",
//    ]);
//});


Route::get('/createdisc', function () {
    return view('createdisc',[
        "title" => "Create Discussion",
    ]);
});

Route::resource('/createdisc', CreateDiscController::class)->middleware('auth');
Route::post('/discussion/{id}', ['CreateDiscController::class','destroy'])->name('createdisc.destroy');


Route::get('/afterbuy', function () {
    return view('afterbuy',[
        "title" => "Confirm Order",
    ]);
});

Route::get('/afterbuy1', function () {
    return view('afterbuy1',[
        "title" => "Confirm Order",
    ]);
});

Route::get('/send-event', function () {
    $text = "Ths is test event";
    broadcast(new HelloEvent($text));
});


//Route::get(uri:"send-event", function (){
//      broadcast(new HelloEvent());
//});
//

Route::get('/freeproducts',[ExploreController::class,'getFree']);
Route::get('/electronicproducts',[ExploreController::class,'getElectronic']);
Route::get('/bookproducts',[ExploreController::class,'getBook']);
Route::get('/femalefashion',[ExploreController::class,'getFemaleFashion']);
Route::get('/malefashion',[ExploreController::class,'getMaleFashion']);
Route::get('/cosmeticproducts',[ExploreController::class,'getCosmetic']);
Route::get('/mahallah',[ExploreController::class,'getMahallah']);
Route::get('/otherproducts',[ExploreController::class,'getOther']);
Route::get('/shoes',[ExploreController::class,'getShoes']);





Route::get('/sendmail',[SendEmailController::class,'index']);

Route::get('/product/search',[ProductController::class,'search']);
Route::post('/likeproduct', [ProductController::class,'storelike'])->middleware('auth');



Route::get('/orders',[ProcessOrderController::class,'getOrder'])->middleware('auth');
Route::get('/prepare/{id}',[ProcessOrderController::class,'prepare'])->middleware('auth');
Route::get('/deliver/{id}',[ProcessOrderController::class,'deliver'])->middleware('auth');
Route::get('/delivering/{id}',[ProcessOrderController::class,'delivering'])->middleware('auth');
Route::get('/receive/{id}',[ProcessOrderController::class,'receive'])->middleware('auth');
Route::get('/received/{id}',[ProcessOrderController::class,'received'])->middleware('auth');
Route::get('/completed/{id}',[ProcessOrderController::class,'completed'])->middleware('auth');
Route::get('/receivedbuyer/{id}',[ProcessOrderController::class,'receivedbuyer'])->middleware('auth');
Route::get('/cancelled',[ProcessOrderController::class,'cancelled'])->middleware('auth');


Route::get('/sold',[SoldController::class,'sold'])->middleware('auth');
Route::get('/pending',[SoldController::class,'pending'])->middleware('auth');

//rate views
Route::resource('/review',ReviewController::class)->middleware('auth');
Route::get('/review/{id}',[ReviewController::class,'displayreview'])->middleware('auth');
Route::get('/review/{id}/edit',[ReviewController::class,'edit'])->name('review.edit')->middleware('auth');

//product review in profile 
Route::get('/productreview',[ReviewController::class,'index'])->middleware('auth');



//Route::resource('/productafterbuy',SoldController::class)->middleware('auth');
//Route::get('/productafterbuy/{id}','SoldController@show')->name('buy.show')->middleware('auth');

Route::resource('/myorder',MyOrderController::class)->middleware('auth');
Route::get('/completed',[MyOrderController::class,'completed'])->middleware('auth');
Route::get('/deliveryorder',[MyOrderController::class,'deliveryorder'])->middleware('auth');
Route::get('/receiveorder',[MyOrderController::class,'receiveorder'])->middleware('auth');
Route::get('/completedorder',[MyOrderController::class,'completedorder'])->middleware('auth');
Route::get('/cancelorder',[MyOrderController::class,'cancelorder'])->middleware('auth');
Route::get('/process',[MyOrderController::class,'process'])->middleware('auth');

//Route::get('/viewproduct', function () {
//   return view('products.viewproduct',[
//       "title" => "View Product",
//  ]);
//});


Route::resource('likes', LikeController::class)->middleware('auth');
//Route::post('/likes', [LikeController::class,'store'])->middleware('auth');
//Route::post('/like.destroy', 'LikeController@destroy')->name('like.destroy')->middleware('auth');


Route::get('/sellerprofile',[SellerProfileController::class,'index']);
Route::get('/sellerprofile/{id}',[SellerProfileController::class,'show'])->name('sellerprofile.show');
Route::get('/sellerreviews/{id}',[SellerProfileController::class,'sellerreview']);


Route::resource('/discussion', DiscussionController::class);
Route::get('/discussion/{discussion}',[DiscussionController::class,'show']);
Route::get('/yourdiscussion',[DiscussionController::class,'yourdiscussion'])->middleware('auth');


Route::resource('/products',ProductController::class);

//for contact the seller
Route::resource('/chat',MessageController::class)->middleware('auth');

//for chat message page
Route::middleware("auth")->group(function (){
    // chat
    Route::prefix("chatpage")->name("chatpage")->group(function (){
        Route::get("/", [ChatController::class, "index"])->name("index");
        Route::post("/",[ChatController::class, "saveMessage"])->name('save');
        Route::get("/load",[ChatController::class, "loadMessage"])->name('load');
    });
    //room
    Route::post("/room", [RoomController::class, "create"])->name("room.create");
    //broadcast auth
    Route::post('/broadcasting/auth', [ChannelAuthorizationController::class, 'authorizeChannel']);

    // logout
    Route::get("/logout", [LoginController::class, "logout"])->name("logout");
});



Route::resource('/buy',OrderController::class)->middleware('auth');
//Route::get('buy/{id}', [OrderController::class, 'show'])->name('buy.show')->middleware('auth');
Route::post('buyproduct',[OrderController::class,'addorder'])->middleware('auth');
Route::post('buy',[OrderController::class,'store'])->middleware('auth');
Route::get('show_items/{ids}', [OrderController::class, 'showitems'])->middleware('auth');


Route::resource('/cart',CartController::class)->middleware('auth');
//Route::get('/cart/{id}', 'CartController@show')->name('cart.show')->middleware('auth');
Route::post('/cart/{id}', [CartController::class,'store'])->middleware('auth');


Route::get('/fashion',[FashionController::class,'index']);
Route::get('/books',[BookController::class,'index']);
Route::get('/electronics',[ElectronicController::class,'index']);
Route::get('/cosmetics',[CosmeticController::class,'index']);
Route::get('/others',[OthersController::class,'index']);

Route::post('/filteredbook', [BookController::class, 'filterProducts'])->name('filter.products');
Route::post('/filteredfashion', [FashionController::class, 'filterProducts'])->name('filter.fashion');
Route::post('/filteredelectronic', [ElectronicController::class, 'filterProducts'])->name('filter.electronics');
Route::post('/filteredelcosmetic', [CosmeticController::class, 'filterProducts'])->name('filter.cosmetics');
Route::post('/filteredelother', [OthersController::class, 'filterProducts'])->name('filter.others');


Route::post('/sort-products', [BookController::class, 'sortProducts'])->name('sort.products');
Route::post('/sort-fashions', [FashionController::class, 'sortProducts'])->name('sort.fashions');
Route::post('/sort-electronics', [ElectronicController::class, 'sortProducts'])->name('sort.electronics');
Route::post('/sort-cosmetics', [CosmeticController::class, 'sortProducts'])->name('sort.cosmetics');
Route::post('/sort-others', [OthersController::class, 'sortProducts'])->name('sort.others');


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
//Route::put('/sell/{id}', [SellController::class, 'update'])->middleware('auth');
Route::get('/sell/{id}/edit', [ SellController::class,'edit'])->name('sell.edit')->middleware('auth');
Route::post('image/upload/store',[ SellController::class,'store'])->middleware('auth');
//Route::get('/sell/show/{id}','SellController@show')->middleware('auth');
Route::get('/get-subcategories/{category}', [SellController::class, 'getSubcategoriesAjax']);


Route::resource('/profile',ProfileController::class)->middleware('auth');

Route::resource('/settings',UserProfileController::class)->middleware('auth');

Route::resource('/payment',BankController::class)->middleware('auth');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->get('/mainpage',function(){
    return view('mainpage');
})->name('mainpage');

//for admin view
Route::get('dashboard',[DashboardController::class,'index'])->middleware('auth');
