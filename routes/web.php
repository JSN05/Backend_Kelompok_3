<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

use App\Models\Post;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    // $posts = Post::all();
    $posts = Post::orderBy('created_at', 'desc')->paginate(10);
    return view('home', compact('posts'));
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/post', [PostController::class, 'create'])->name('post.create');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
});

require __DIR__ . '/auth.php';
