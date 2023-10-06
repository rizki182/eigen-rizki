<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookUnitController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MemberController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/book', [BookController::class, 'list']);
Route::get('/book/unit', [BookUnitController::class, 'list']);
Route::get('/book/unit/{id}', [BookUnitController::class, 'detail'])->where('id', '[0-9]+');
Route::get('/book/{id}', [BookController::class, 'detail'])->where('id', '[0-9]+');

Route::get('/transaction/borrow/member', [TransactionController::class, 'borrow_member']);
Route::get('/transaction/borrow/book', [TransactionController::class, 'borrow_book']);
Route::post('/transaction/borrow', [TransactionController::class, 'borrow']);

Route::get('/transaction/return/member', [TransactionController::class, 'return_member']);
Route::get('/transaction/return/book', [TransactionController::class, 'return_book']);
Route::post('/transaction/return', [TransactionController::class, 'return']);

Route::get('/member', [MemberController::class, 'list']);
Route::get('/member/{id}', [MemberController::class, 'detail'])->where('id', '[0-9]+');

