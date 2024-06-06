<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\CommentController;
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
Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
Route::get('/mypage/profile', [UserController::class, 'edit'])->name('profile');
Route::get('/sell', [SellController::class, 'edit'])->name('sell');
Route::get('/purchase/item_id', [PurchaseController::class, 'create'])->name('purchase');
Route::get('/purchase/address/item_id', [AddressController::class, 'edit'])->name('address');
Route::get('/item/comment/item_id', [CommentController::class, 'show'])->name('comment');
