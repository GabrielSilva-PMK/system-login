<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\MenuAdminController;
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

    // Route::resource('/user', UserController::class);

    // UserAdminController
    Route::get('/user',  [UserAdminController::class, 'index'])->name('user.index');
    Route::get('/user/create',  [UserAdminController::class, 'create'])->name('user.create');
    // Route::post('/user',  [UserAdminController::class, 'store'])->name('user.store');
    Route::get('/user/{id}',  [UserAdminController::class, 'edit'])->name('user.edit');
    // Route::put('/user/{id}',  [UserAdminController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}',  [UserAdminController::class, 'destroy'])->name('user.destroy');

    // MenuAdminController
    Route::get('/menu',  [MenuAdminController::class, 'index'])->name('menu.index');
    Route::get('/menu/create',  [MenuAdminController::class, 'create'])->name('menu.create');
    // Route::post('/menu',  [MenuAdminController::class, 'store'])->name('menu.store');
    Route::get('/menu/{id}',  [MenuAdminController::class, 'edit'])->name('menu.edit');
    // Route::put('/menu/{id}',  [MenuAdminController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{id}',  [MenuAdminController::class, 'destroy'])->name('menu.destroy');

// });
