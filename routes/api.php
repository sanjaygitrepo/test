<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('users/login',[UserController::class,'login']);
Route::apiResource('/users',UserController::class)
        ->missing(function (Request $request) {

            return response()->json(['error'=>'user not found'],404);
            
        });

Route::post('posts/create',[PostController::class,'create']);        
Route::get('posts',[PostController::class,'index']);        

Route::fallback(function() {
            return response()->json(['error'=>'Invalid route'],404);
    
});        
