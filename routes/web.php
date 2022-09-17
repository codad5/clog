<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/', [Controllers\PostsController::class, 'index']);
Route::get('/about', [Controllers\PagesController::class, 'about']);
Route::get('/services', [Controllers\PagesController::class, 'services']);
Route::resource('posts', Controllers\PostsController::class);

//auth routes
Route::get('/login', [Controllers\UsersAuthController::class, 'index']);
Route::post('/login', [Controllers\UsersAuthController::class, 'login']);
Route::get('/registration123', [Controllers\UsersAuthController::class, 'registration']);
Route::post('/registration', [Controllers\UsersAuthController::class, 'postRegistration']);
Route::get('/dashboard', [Controllers\UsersAuthController::class, 'dashboard'])
->middleware('user.loggedIn');
Route::get('/logout', [Controllers\UsersAuthController::class, 'logout'])
->middleware('user.loggedIn');
