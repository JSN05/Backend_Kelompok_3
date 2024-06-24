<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;

use App\Models\Post;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    // $posts = Post::all();
    // $posts = Post::orderBy('created_at', 'desc')->paginate(10);
    // 13 06 2024 Michael, menambahkan user ke masing-masing post untuk support fitur visit profil start
    $posts = Post::orderBy('created_at', 'desc')->get();
    foreach ($posts as $post) {
        $post->user = User::where('email', $post->username)->first();
    }
    // 13 06 2024 Michael, menambahkan user ke masing-masing post untuk support fitur visit profil end
    return view('home', compact('posts'));
})->middleware(['auth', 'verified'])->name('home');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //13 06 2024 Michael, route untuk visit profile start
    Route::get('/profile/{user}', [ProfileController::class, 'visit'])->name('profile.visit');
    //13 06 2024 Michael, route untuk visit profile end

    Route::get('/post/visit/{post}', [PostController::class, 'visit'])->name('post.visit');


    Route::get('/post', [PostController::class, 'create'])->name('post.create');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

    //13 06 2024 Michael, route untuk fitur follow start
    Route::post('/follow/{id}', [FollowController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{id}', [FollowController::class, 'unfollow'])->name('unfollow');
    //13 06 2024 Michael, route untuk fitur follow end
});

require __DIR__ . '/auth.php';

