<?php

use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\ThanksController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class,'showLoginForm'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'login']);
});

Route::get('/thanks', [ThanksController::class, 'index'])->name('thanks');

Route::get('/done', [ReservationController::class, 'done'])->name('reservation.done');

Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);

Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');

Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    Route::post('/logout-confirm', [AuthenticatedSessionController::class, 'showLogoutConfirm'])->name('logout.confirm');
    Route::delete('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout.destroy');
});

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/', [HomeController::class, 'index'])->name('home');
