<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controllers;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return redirect ('/login');
});
// Auth Routes
Route::controller(App\Http\Controllers\AuthController::class)->group(function () {
   Route::get('/login',                'index')->name('login');
   Route::post('/authenticate',        'authenticate');
   Route::get('/logout',               'logout');
   Route::get('/register',             'register');
});

// Dashboard Routes
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']); 

Route::prefix('module')->group(function () {
   Route::controller(App\Http\Controllers\ModuleController::class)->group(function () {
      Route::get('/',                        'index');
      Route::get('/list',                    'list');
      Route::get('/create',                  'create');
      Route::post('/store',                  'store');
      Route::get('/edit/{id}',               'edit');
      Route::post('/update',                 'update');
      Route::post('/destroy',                'destroy');
      Route::get('/show/{id}',               'show');
   });
});

Route::prefix('lesson')->group(function () {
   Route::controller(App\Http\Controllers\LessonController::class)->group(function () {
      Route::get('/',                        'index');
      Route::get('/list',                    'list');
      Route::get('/create/{id}',             'create');
      Route::post('/store',                  'store');
      Route::get('/edit/{id}',               'edit');
      Route::post('/update',                 'update');
      Route::post('/destroy',                'destroy');
      Route::get('/show/{id}',               'show');
   });
});

Route::prefix('quiz')->group(function () {
   Route::controller(App\Http\Controllers\QuizController::class)->group(function () {
      Route::get('/',                        'index');
      Route::get('/list',                    'list');
      Route::get('/create',                  'create');
      Route::post('/store',                  'store');
      Route::get('/edit/{id}',               'edit');
      Route::post('/update',                 'update');
      Route::post('/destroy',                'destroy');
      Route::get('/show/{id}',               'show');
   });
});

Route::prefix('user')->group(function () {
   Route::controller(App\Http\Controllers\UserController::class)->group(function () {
      Route::get('/',                        'index');
      Route::get('/list/{utype}',            'list');
      Route::get('/create',                  'create');
      Route::post('/store',                  'store');
      Route::get('/edit/{id}',               'edit');
      Route::get('/security/{id}',           'security');
      Route::post('/update',                 'update');
      Route::post('/destroy',                'destroy');
   });
});

Route::prefix('admin')->group(function () {
   Route::controller(App\Http\Controllers\UserController::class)->group(function () {
      Route::get('/',                        'index');
      Route::get('/list/{utype}',            'list');
      Route::get('/create',                  'create');
      Route::post('/store',                  'store');
      Route::get('/edit/{id}',               'edit');
      Route::get('/security/{id}',           'security');
      Route::post('/update',                 'update');
      Route::post('/destroy',                'destroy');
      Route::get('/profile/{id}',            'profile');
      Route::post('/account',                'account');
   });
});

Route::prefix('settings')->group(function () {
   Route::controller(App\Http\Controllers\SettingsController::class)->group(function () {
      Route::get('/',                        'index');
      Route::get('/edit',                    'edit');
      Route::post('/update',                 'update');
   });
});

Route::prefix('terms')->group(function () {
   Route::controller(App\Http\Controllers\TermsController::class)->group(function () {
      Route::get('/',                        'index');
      Route::get('/edit',                    'edit');
      Route::post('/update',                 'update');
   });
});

Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);
Route::get('500', ['as' => '500', 'uses' => 'ErrorController@fatal']);
 

Route::get('/images/{file}', function ($file) {
   $path = storage_path() . '/images/' . $file;

   if(!File::exists($path)) abort(404);

   $file = File::get($path);
   $type = File::mimeType($path);

   $response = Response::make($file, 200);
   $response->header("Content-Type", $type);

   return $response;
});

