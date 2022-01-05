<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
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
    $posts = Post::with('tags', 'category')->take(5)->latest(10)->paginate(10);
    return view('pages.home', compact('posts'))->name('home');
});

Route::get('post', [\App\Http\Controllers\PostController::class, 'index'])->name('post.index');
Route::view('about', 'pages.about')->name('post.about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
