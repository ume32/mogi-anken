<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🛍️ 商品関連
Route::get('/', [ItemController::class, 'index'])->name('items.index');  // 商品一覧
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('items.show'); // 商品詳細
Route::get('/sell', [ItemController::class, 'create'])->name('items.create'); // 出品ページ
Route::post('/sell', [ItemController::class, 'store'])->name('items.store');  // 出品処理

// 🔐 認証不要（ログイン・登録）
Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('auth.register'); // 会員登録画面
    Route::post('/register', 'register'); // 会員登録処理
    Route::get('/login', 'showLogin')->name('auth.login'); // ログイン画面
    Route::post('/login', 'login')->name('login'); // ログイン処理
});

// 🔑 認証必須（ログイン済みのユーザーのみアクセス可）
Route::middleware('auth')->group(function () {
    
    // 👤 ユーザー関連
    Route::prefix('mypage')->group(function () {
        Route::get('/', [UserController::class, 'showProfile'])->name('mypage.index'); // マイページ
        Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit'); // プロフィール編集
        Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update'); // プロフィール更新
        Route::get('/mylist', [ItemController::class, 'myList'])->name('items.myList'); // マイリスト
    });

    // 🛒 購入関連
    Route::prefix('purchase')->group(function () {
        Route::get('/{item_id}', [PurchaseController::class, 'show'])->name('purchase.show'); // 購入画面
        Route::post('/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store'); // 購入処理
        Route::get('/{item_id}/confirm', [PurchaseController::class, 'confirm'])->name('purchase.confirm'); // 購入確認画面
        
        // 📦 住所変更
        Route::get('/address/{item_id}', [AddressController::class, 'edit'])->name('address.edit'); // 住所変更画面
        Route::post('/address/{item_id}', [AddressController::class, 'update'])->name('address.update'); // 住所更新処理
    });

    // 💬 コメント投稿
    Route::post('/item/{item_id}/comments', [CommentController::class, 'store'])->name('comments.store');

    // 🔓 ログアウト
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::post('/favorite/{item_id}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');

