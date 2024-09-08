<?php

use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThanksController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
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
Auth::routes(['verify' => true]);

Route::get('/register', [AuthController::class,'getRegister'])->name('register');
Route::post('/register', [AuthController::class,'postRegister']);

Route::get('/login', [AuthController::class,'getLogin'])->name('login');;
Route::post('/login', [AuthController::class,'postLogin']);

Route::get('/thanks', [ThanksController::class, 'index'])->name('thanks');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shops/{id}', [ShopController::class, 'show'])->name('shops.show');
Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('shop.detail');
Route::post('/manager/save-image/{shop}', [ShopController::class, 'saveImage'])->name('manager.save-image');

Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');
    Route::delete('/reservation/{id}', [MyPageController::class, 'destroy'])->name('reservation.destroy');
    Route::patch('/reservation/{id}', [MyPageController::class, 'update'])->name('reservation.update');
    Route::post('/logout', [AuthController::class, 'getLogout'])->name('logout');
    Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/done/{reservation_id}', [ReservationController::class, 'done'])->name('reservation.done');
});

Route::post('/shop/like/{id}', [HomeController::class, 'like'])->name('shop.like');
Route::post('/shop/unlike/{id}', [HomeController::class, 'unlike'])->name('shop.unlike');
Route::get('/search', [HomeController::class, 'search'])->name('shop.search');

Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.page');

Route::prefix('manager')->middleware(['auth'])->group(function () {
    Route::get('dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('shops', [ManagerController::class, 'shops'])->name('manager.shops');
    Route::get('shops/create', [ManagerController::class, 'createShop'])->name('manager.create-shop');
    Route::post('shops', [ManagerController::class, 'storeShop'])->name('manager.store-shop');
    Route::get('shops/{shop}/edit', [ManagerController::class, 'editShop'])->name('manager.edit-shop');
    Route::put('shops/{shop}', [ManagerController::class, 'updateShop'])->name('manager.update-shop');
    Route::get('reservations', [ManagerController::class, 'reservations'])->name('manager.reservations');
    Route::get('create-manager', [ManagerController::class, 'createManager'])->name('manager.createManager');
    Route::post('store-manager', [ManagerController::class, 'storeManager'])->name('manager.storeManager');
    Route::get('/notifications/create', [NotificationController::class, 'create'])->name('notifications.create');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
});

Route::prefix('admin')->group(function () {
    Route::get('register', [AdminAuthController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('register', [AdminAuthController::class, 'register']);

    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('/create', [PaymentController::class, 'create'])->name('create');
    Route::post('/store', [PaymentController::class, 'store'])->name('store');
});

