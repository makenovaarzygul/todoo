<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoExtendController;
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
Route::resource('/todo',TodoController::class)->middleware('auth');
Route::post('todo/destory/bulk',[TodoController::class,'bulkDestroy'])->name('todo.destroy.bulk')->middleware('auth');
Route::post('todo/edit/bulk',[TodoController::class,'bulkEdit'])->name('todo.edit.bulk')->middleware('auth');
Route::put('todo/edit/bulk',[TodoController::class,'bulkUpdate'])->name('todo.edit.bulk.submit')->middleware('auth');
Route::get('todo/calendar/view', [TodoExtendController::class, 'calendar'])->name('todo.calendar');
Route::get('todo/calendar/view', [TodoExtendController::class, 'calendar'])->name('todo.calendar');


Route::get('/', [UserController::class, 'authPage'])->middleware('guest')->name('login');
Route::post('/', [UserController::class, 'authAction'])->name('authAction');

Route::get('/register', [UserController::class, 'registerPage'])->middleware('guest');
Route::post('/register', [UserController::class, 'registerAction'])->name('registerAction');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');


