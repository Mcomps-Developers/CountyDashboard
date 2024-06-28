<?php

use App\Livewire\Adminstration\AddSubcounty;
use App\Livewire\Adminstration\EditSubcounty;
use App\Livewire\Adminstration\ShowSubcounty;
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
use App\Livewire\Documents\AddFolders;
use App\Livewire\Documents\AllDocuments;
use App\Livewire\Documents\EditFolders;
use App\Livewire\Documents\ShowFolders;
use App\Livewire\Events\AddEvent;
use App\Livewire\Events\AddEventCategory;
use App\Livewire\Events\EditEvent;
use App\Livewire\Events\EventCategories;
use App\Livewire\Events\EventsPerCategory;
use App\Livewire\HomeComponent;
use App\Livewire\Pages\AddDocuments;
use App\Livewire\Pages\AddSlider;
use App\Livewire\Pages\CountyRevenueBoard;
use App\Livewire\Pages\DeputyGovernor;
use App\Livewire\Pages\EditDocuments;
use App\Livewire\Pages\HomeSliders;
use App\Livewire\Pages\HomeStats;
use App\Livewire\Pages\HomeWelcome;
use App\Livewire\Pages\PublicService;
use App\Livewire\Pages\ShowDocuments;
use App\Livewire\Pages\TheGovernor;
use App\Livewire\Projects\AddProject;
use App\Livewire\Projects\EditProject;
use App\Livewire\Projects\ShowProjects;
use App\Livewire\Wards\AddShowWard;
use App\Livewire\Wards\EditShowWard;
use App\Livewire\Wards\ShowWards;
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
    // Pages
    Route::prefix('pages')->group(function () {
        Route::get('/stats', HomeStats::class)->name('stats');
        Route::get('/welcome-note', HomeWelcome::class)->name('home.welcome');
        Route::get('/the-governor', TheGovernor::class)->name('the-governor');
        Route::get('/deputy-governor', DeputyGovernor::class)->name('deputy-governor');
        Route::get('/cpsb', PublicService::class)->name('public.service');
        Route::get('/crb', CountyRevenueBoard::class)->name('crb');
    });

    // Projects
    Route::prefix('projects')->group(function () {
        Route::get('/show', ShowProjects::class)->name('projects.show');
        Route::get('/add', AddProject::class)->name('project.add');
        Route::get('/edit/{project_id}', EditProject::class)->name('project.edit');
    });

    // Documents
    Route::prefix('folders')->group(function () {
        Route::get('/show', ShowFolders::class)->name('folders.show');
        Route::get('/add', AddFolders::class)->name('folder.add');
        Route::get('/edit/{folder_id}', EditFolders::class)->name('folder.edit');

        // Files
        Route::get('/show/{folder_id}', ShowDocuments::class)->name('documents.show');
        Route::get('/add/{folder_id}', AddDocuments::class)->name('document.add');
        Route::get('/file/edit/{file_id}', EditDocuments::class)->name('document.edit');
        Route::get('/all-documents', AllDocuments::class)->name('documents');
    });

    // Sliders
    Route::prefix('sliders')->group(function () {
        Route::get('/view', HomeSliders::class)->name('home.sliders');
        Route::get('/add', AddSlider::class)->name('slider.add');
        Route::get('/edit/{reference}', AddSlider::class)->name('slider.edit');
    });

    // Subcounties

    Route::prefix('constituencies')->group(function () {
        Route::get('/view', ShowSubcounty::class)->name('subCounties.show');
        Route::get('/add', AddSubcounty::class)->name('subCounty.add');
        Route::get('/edit/{subCounty_id}', EditSubcounty::class)->name('subCounty.edit');
    });

    Route::prefix('wards')->group(function () {
        Route::get('/view/{subCounty_id}', ShowWards::class)->name('wards.show');
        Route::get('/add/{subCounty_id}', AddShowWard::class)->name('ward.add');
        Route::get('/edit/{ward_id}', EditShowWard::class)->name('ward.edit');
    });

    // Departments
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
