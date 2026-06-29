<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name(
    'category.show',
);
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name(
    'article.show',
);
Route::get('/author/{id}', [AuthorController::class, 'show'])->name(
    'author.show',
);

Route::get('/dashboard', function () {
    $bookmarkedArticles = request()
        ->user()
        ->bookmarkedArticles()
        ->with(['category', 'author', 'media'])
        ->orderByPivot('created_at', 'desc')
        ->take(12)
        ->get();

    return view('dashboard', compact('bookmarkedArticles'));
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name(
        'profile.edit',
    );
    Route::patch('/profile', [ProfileController::class, 'update'])->name(
        'profile.update',
    );
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name(
        'profile.destroy',
    );
});

require __DIR__.'/auth.php';
