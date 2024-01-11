<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\IndexController;

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

Route::get('/', [IndexController::class, 'index']);
Route::get('/about', [IndexController::class, 'about']);

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');

Route::get('movies/{movie}', [MovieController::class, 'show'])->name('movies.show');