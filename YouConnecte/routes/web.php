<?php

use App\Http\Controllers\CommeterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\LikeController;
use App\Models\Commeter;

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

Route::get('/accueil', [PublicationController::class, 'index'])->name('accueil');
Route::get('/{id}/poste', [PublicationController::class, 'ShowPoste'])->name('poste');

Route::get('/register', [UserController::class, 'showAccount'])->name('account');
Route::get('/', [UserController::class, 'index'])->name('home');
Route::post('/registerUser', [UserController::class, 'creatAccount'])->name('accountCreat');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::get('/create', [PublicationController::class, 'getPublicationUser'])->name('publication.create');
Route::post('/bo', [PublicationController::class, 'store'])->name('publication.store');

Route::get('/{id}/edit', [PublicationController::class, 'edit'])->name('publication.edit');
Route::delete('/publication/{id}', [PublicationController::class, 'destroy'])->name('publication.destroy');
Route::put('/{id}', [PublicationController::class, 'update'])->name('publication.update');




Route::get('/likes/{id}', [LikeController::class, 'store']);
Route::get('/likesdelet/{id}', [LikeController::class, 'delete']);





Route::get('/likes/{id}', [LikeController::class, 'store']);
Route::get('/likesdelet/{id}', [LikeController::class, 'delete']);


Route::post('/{id}', [CommeterController::class, 'store'])->name('commenter');
Route::delete('/{id}/destroy', [CommeterController::class, 'destroy'])->name('comment.destroy');

Route::post('/abonne/{id}', [CommeterController::class, 'store'])->name('abonne');
Route::delete('/abonneDestroy/{id}', [CommeterController::class, 'delete'])->name('abonne.destroy');
