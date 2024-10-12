<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
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
    $users = User::all();
    return view('users.index', compact('users'));
});

Route::get('/users', function () {
    return view('users');
})->middleware(['auth'])->name('users');

require __DIR__.'/auth.php';

Route::get('/test', [TestController::class, 'index']);

Route::resource('users', UserController::class);
