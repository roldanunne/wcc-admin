<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Auth Routes
Route::prefix('wcc')->group(function () {
    Route::controller(App\Http\Controllers\Api\AuthController::class)->group(function () { 
        Route::post('/authenticate',        'authenticate'); 
        Route::post('/user_data',           'user_data'); 
        Route::post('/update_password',     'update_password'); 
    });
});

Route::prefix('wcc')->group(function () {
    Route::controller(App\Http\Controllers\Api\DataController::class)->group(function () { 
        Route::get('/terms_data',           'terms_data'); 
        Route::get('/settings_data',        'settings_data'); 
        Route::get('/module_list',          'module_list');
        Route::get('/quiz_list',            'quiz_list');
        Route::post('/take_quiz_list',      'take_quiz_list');
        Route::post('/take_quiz',           'take_quiz'); 
    });
});
