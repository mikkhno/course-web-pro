<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('login', [AuthController::class,'login'])->name('login');
Route::get('reg', [AuthController::class,'registration'])->name('reg');
Route:: post('/register', [AuthController::class,'create'])->name('register');
Route::get('main/{id}',[ContentController::class,'main'])->name('main');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');
Route::post('content/{id}', [ContentController::class, 'content'])->name('content');
Route::get('/allgroups', [ContentController::class, 'show_all_groups'])->name('allgroups');
