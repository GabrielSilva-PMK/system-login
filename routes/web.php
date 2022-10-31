<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'autentication'])->name('login-autentication');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/sessionexpire', [HomeController::class, 'sessionexpire'])->name('home.sessionexpire');

// Route::get('/password', [PasswordController::class, 'index'])->name('password');

// Route::group(['middleware' => ['front', 'web']], function (){

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Route::resource('/book', BookController::class);

// });
