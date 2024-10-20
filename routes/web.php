<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordPressController;
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

Route::get('/create-post', function () {
    return view('wordpress.wordpress_post');
})->name('createPostForm'); // Route to show the form

Route::get('/view-post/{id}', [WordPressController::class, 'viewPost'])->name('viewPost');

Route::post('/post-to-wordpress', [WordPressController::class, 'postToWordPress'])->name('postToWordPress'); // Route to handle form submission

// Route to fetch and display posts
Route::get('/wordpress-posts', [WordPressController::class, 'getAllPosts'])->name('wordpressPosts');

// Route to handle post deletion
Route::delete('/delete-post/{id}', [WordPressController::class, 'deletePost'])->name('deletePost');

// Route to show the edit form
Route::get('/edit-post/{id}', [WordPressController::class, 'editPostForm'])->name('editPost');

// Route to handle post update
Route::post('/update-post/{id}', [WordPressController::class, 'updatePost'])->name('updatePost');

