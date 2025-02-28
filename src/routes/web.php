<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('items.show');
Route::get('/sell', [ItemController::class, 'create'])->name('items.create');
Route::post('/sell', [ItemController::class, 'store'])->name('items.store');

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('auth.register');
    Route::post('/register', 'register');
    Route::get('/login', 'showLogin')->name('auth.login');
    Route::post('/login', 'login')->name('login');
});

Route::middleware('auth')->group(function () {

    Route::prefix('mypage')->group(function () {
        Route::get('/', [UserController::class, 'showProfile'])->name('mypage.index');
        Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
        Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::get('/mylist', [ItemController::class, 'myList'])->name('items.myList');
    });

    Route::prefix('purchase')->group(function () {
        Route::get('/{item_id}', [PurchaseController::class, 'show'])->name('purchase.show');
        Route::post('/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');
        Route::get('/{item_id}/confirm', [PurchaseController::class, 'confirm'])->name('purchase.confirm');

        Route::get('/address/{item_id}', [AddressController::class, 'edit'])->name('address.edit');
        Route::post('/address/{item_id}', [AddressController::class, 'update'])->name('address.update');
    });

    Route::post('/item/{item_id}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::post('/favorite/{item_id}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
