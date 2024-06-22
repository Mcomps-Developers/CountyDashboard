<?php

use App\Livewire\Blog\AddBlog;
use App\Livewire\Blog\AddBlogCategory;
use App\Livewire\Blog\BlogCategories;
use App\Livewire\Blog\BlogCategory;
use App\Livewire\Blog\EditBlog;
use App\Livewire\Departments\AddDepartment;
use App\Livewire\Departments\Directorates\AddDirectorates;
use App\Livewire\Departments\Directorates\EditDirectorates;
use App\Livewire\Departments\Directorates\ShowDirectorates;
use App\Livewire\Departments\EditDepartment;
use App\Livewire\Departments\ViewDepartments;
use App\Livewire\Events\AddEvent;
use App\Livewire\Events\AddEventCategory;
use App\Livewire\Events\EditEvent;
use App\Livewire\Events\EventCategories;
use App\Livewire\Events\EventsPerCategory;
use App\Livewire\HomeComponent;
use App\Livewire\Pages\AddSlider;
use App\Livewire\Pages\DeputyGovernor;
use App\Livewire\Pages\HomeSliders;
use App\Livewire\Pages\HomeStats;
use App\Livewire\Pages\HomeWelcome;
use App\Livewire\Pages\TheGovernor;
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
    Route::prefix('pages')->group(function () {
        Route::get('/stats', HomeStats::class)->name('stats');
        Route::get('/welcome-note', HomeWelcome::class)->name('home.welcome');
        Route::get('/the-governor', TheGovernor::class)->name('the-governor');
        Route::get('/deputy-governor', DeputyGovernor::class)->name('deputy-governor');
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/view', HomeSliders::class)->name('home.sliders');
        Route::get('/add', AddSlider::class)->name('slider.add');
        Route::get('/edit/{reference}', AddSlider::class)->name('slider.edit');
    });

    Route::prefix('departments')->group(function () {
        Route::get('/view', ViewDepartments::class)->name('departments.view');
        Route::get('/add', AddDepartment::class)->name('department.add');
        Route::get('/edit/{slug}', EditDepartment::class)->name('department.edit');
        Route::prefix('directorate')->group(function () {
            Route::get('/view/{slug}', ShowDirectorates::class)->name('directory.view');
            Route::get('/add/{slug}', AddDirectorates::class)->name('directory.add');
            Route::get('/edit/{id}', EditDirectorates::class)->name('directory.edit');
        });
    });
});
