<?php

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

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/requests_month', [App\Http\Controllers\HomeController::class, 'requests_month'])->name('requests_month');
Route::get('/requests_item', [App\Http\Controllers\HomeController::class, 'requests_item'])->name('requests_item');
Route::resource('users', App\Http\Controllers\Master\UserController::class);
Route::resource('bank', App\Http\Controllers\Master\BankController::class);
Route::resource('items', App\Http\Controllers\Master\ItemController::class);
Route::resource('requests', App\Http\Controllers\RequestsController::class);
Route::resource('requests_approval', App\Http\Controllers\RequestsApprovalController::class);
Route::get('requests_approval/json/{listFlag}', [App\Http\Controllers\RequestsApprovalController::class, 'approval_json'])->name('requests_approval.json');
Route::get('requests_approval/review/{id}', [App\Http\Controllers\RequestsApprovalController::class, 'approval_review'])->name('requests_approval.review');
Route::resource('requests_finance', App\Http\Controllers\RequestsFinanceController::class);
Route::get('requests_finance/json/{listFlag}', [App\Http\Controllers\RequestsFinanceController::class, 'finance_json'])->name('requests_finance.json');
