<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Blog\Index as BlogIndex;
use App\Http\Livewire\Blog\Show as BlogShow;
use App\Http\Livewire\Posts\Index as PostsIndex;
use App\Http\Livewire\Posts\Create as PostsCreate;
use App\Http\Livewire\Posts\Edit as PostsEdit;
use App\Http\Controllers\PostController;

Route::get('/', fn() => redirect()->route( 'blog.index'));

Route::get('/blog', BlogIndex::class)->name('blog.index');
Route::get('/blog/{slug}', BlogShow::class)->name('blog.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('blog.index'); // redirect to posts index
    })->name('dashboard');
    Route::get('/dashboard/posts', PostsIndex::class)->name('posts.index');
    Route::get('/dashboard/posts/create', PostsCreate::class)->name('posts.create');
    Route::get('/dashboard/posts/{post}/edit', PostsEdit::class)->name('posts.edit');
    Route::put('/dashboard/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/dashboard/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

require __DIR__ . '/auth.php';
