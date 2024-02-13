<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/home', function () {
    return view('welcome');
});
Route::get('/register', [UserController::class, 'showAccount'])->name('account');
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::post('/registerUser', [UserController::class, 'creatAccount'])->name('accountCreat');
    Route::post('/login', [UserController::class, 'login'])->name('login');
