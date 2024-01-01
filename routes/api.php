<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::prefix('')
//     ->middleware([
//         'auth:sanctum'
//     ])
//     ->group(function (){
//       //  \App\Helpers\Routes\RouteHelper::includeRouteFiles(__DIR__ . '/api/v1');

// //        require __DIR__ . '/api/users.php';
// //        require __DIR__ . '/api/posts.php';
// //        require __DIR__ . '/api/comments.php';

//     });

Route::post('/register', [RegisterController::class,'store']);
Route::post('/login', [LoginController::class,'authenticate']);

Route::get('/users',[LoginController::class,'index']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Broadcast::routes(['middleware' => ['auth:sanctum']]);