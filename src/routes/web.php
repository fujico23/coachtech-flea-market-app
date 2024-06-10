<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PurchaseController;
use App\Models\User;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ItemController::class, 'index'])->name('index');
Route::get('/item/{item}', [ItemController::class, 'detail'])->name('detail');
Route::middleware('auth')->group(function () {
    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/sell', [SellController::class, 'edit'])->name('sell');
    Route::post('/sell/listing', [SellController::class, 'store'])->name('sell.listing');
    Route::get('/categories/{parentId}/subcategories', [CategoryController::class, 'getSubCategories']);

    Route::get('/purchase/{item}', [PurchaseController::class, 'create'])->name('purchase');
    Route::get('/purchase/address/item_id', [PurchaseController::class, 'edit'])->name('address');
    Route::post('/favorite/add/{item}', [FavoriteController::class, 'store'])->name('favorite.add');
    Route::delete('/favorite/destroy/{item}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');
    Route::get('/item/comment/{item}', [CommentController::class, 'show'])->name('comment');
    Route::post('/item/comment/{item}', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('item/comment/{item}', [CommentController::class, 'destroy'])->name('comment.destroy');
});
