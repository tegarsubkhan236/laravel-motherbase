<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogCategoryController;
use Modules\Blog\Http\Controllers\BlogPostController;

Route::prefix('/blog')->name('blog.')->group(function() {
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [BlogCategoryController::class, 'index'])->name('index');
        Route::get('/create', [BlogCategoryController::class, 'create'])->name('create');
        Route::post('/store', [BlogCategoryController::class, 'store'])->name('store');
        Route::get('/{blog_category}/detail', [BlogCategoryController::class, 'show'])->name('detail');
        Route::get('/{blog_category}/edit', [BlogCategoryController::class, 'edit'])->name('edit');
        Route::put('/{blog_category}/update', [BlogCategoryController::class, 'update'])->name('update');
        Route::delete('/{blog_category}/delete', [BlogCategoryController::class, 'delete'])->name('delete');
    });

    Route::prefix('post')->name('post.')->group(function () {
        Route::get('/', [BlogPostController::class, 'index'])->name('index');
        Route::get('/create', [BlogPostController::class, 'create'])->name('create');
        Route::post('/store', [BlogPostController::class, 'store'])->name('store');
        Route::get('/{blog_post}/detail', [BlogPostController::class, 'show'])->name('detail');
        Route::get('/{blog_post}/edit', [BlogPostController::class, 'edit'])->name('edit');
        Route::put('/{blog_post}/update', [BlogPostController::class, 'update'])->name('update');
        Route::delete('/{blog_post}/delete', [BlogPostController::class, 'delete'])->name('delete');
    });
});
