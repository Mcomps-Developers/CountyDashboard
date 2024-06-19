<?php

use App\Livewire\Blog\AddBlog;
use App\Livewire\Blog\AddBlogCategory;
use App\Livewire\Blog\BlogCategories;
use App\Livewire\Blog\BlogCategory;
use App\Livewire\Blog\EditBlog;
use App\Livewire\Events\AddEvent;
use App\Livewire\Events\AddEventCategory;
use App\Livewire\Events\EditEvent;
use App\Livewire\Events\EventCategories;
use App\Livewire\Events\EventsPerCategory;
use App\Livewire\HomeComponent;
use App\Livewire\Pages\HomeStats;
use App\Livewire\Pages\HomeWelcome;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', HomeComponent::class);
    Route::prefix('/blogging')->group(function () {
        Route::get('/categories', BlogCategories::class)->name('blog.categories');
        Route::get('/category/add', AddBlogCategory::class)->name('blog.category.add');
        Route::get('/category/{slug}', BlogCategory::class)->name('blog.category');
        Route::get('/add-blog/category/{slug}', AddBlog::class)->name('blog.add');
        Route::get('/edit-blog/{reference}', EditBlog::class)->name('blog.edit');
    });

    // Events
    Route::prefix('/events')->group(function () {
        Route::get('/categories', EventCategories::class)->name('events.categories');
        Route::get('/category/{slug}', EventsPerCategory::class)->name('events.category');
        Route::get('/add-category', AddEventCategory::class)->name('event.category.add');
        Route::get('/category/{slug}/add', AddEvent::class)->name('event.add');
        Route::get('/edit/{reference}', EditEvent::class)->name('event.edit');
    });

    Route::get('/stats', HomeStats::class)->name('stats');
    Route::get('/home-welcome-note', HomeWelcome::class)->name('home.welcome');
});

