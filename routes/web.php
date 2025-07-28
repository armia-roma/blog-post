<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('welcome');
});
Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware(['auth', 'verified']);

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware(['auth', 'verified']);

Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware(['auth', 'is_admin']);


Route::middleware(['auth', 'is_admin'])->patch('/posts/{post}/status', [PostController::class, 'updateStatus'])->name('posts.updateStatus');

Route::get('/dashboard', function () {
     $posts = Post::where('status', 'published')->latest()->paginate(10); // paginate 10 per page

        // Pass posts to the view
        return view('dashboard', compact('posts'));

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
