<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;

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
    return view('mainmenu');
});

require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth'], function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Question
    Route::resource('questions', QuestionController::class);

    // Comments
    Route::resource('comments', CommentController::class);

    // Comments
    Route::resource('categories', CategoryController::class)->except('show');

    // Accounts
    Route::resource('accounts', UserController::class)->except(['show', 'create', 'store', 'destroy']);
});
