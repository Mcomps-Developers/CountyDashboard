<?php

use App\Livewire\Blog\AddBlog;
use App\Livewire\Blog\AddBlogCategory;
use App\Livewire\Blog\BlogCategories;
use App\Livewire\Blog\News;
use App\Livewire\Blog\Publications;
use App\Livewire\Blog\Speeches;
use App\Livewire\HomeComponent;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', HomeComponent::class);
    Route::prefix('/blogging')->group(function () {
        Route::get('/categories', BlogCategories::class)->name('blog.categories');
        Route::get('/add-category', AddBlogCategory::class)->name('blog.category.add');
        Route::get('/category/{slug}', Speeches::class)->name('blog.category');
        Route::get('/news', News::class)->name('blog.news');
        Route::get('/publications', Publications::class)->name('blog.publications');
        Route::get('/add-blog', AddBlog::class)->name('blog.add');
    });
});

