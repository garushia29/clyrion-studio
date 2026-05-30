<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/about', 'pages.about')->name('about');
Route::view('/projects', 'pages.projects')->name('projects.index');
Route::view('/blog', 'pages.blog')->name('blog.index');

Route::get('/sitemap.xml', function () {
    $urls = [
        ['loc' => url('/'), 'priority' => '1.0'],
        ['loc' => url('/about'), 'priority' => '0.9'],
        ['loc' => url('/projects'), 'priority' => '0.8'],
        ['loc' => url('/blog'), 'priority' => '0.7'],
    ];

    return response()->view('sitemap', ['urls' => $urls])->header('Content-Type', 'application/xml');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'projectsCount' => \App\Models\Project::count(),
        'postsCount' => \App\Models\Post::count(),
        'usersCount' => \App\Models\User::count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/projects', \App\Livewire\Admin\ProjectList::class)->name('projects.index');
    Route::get('/projects/create', \App\Livewire\Admin\ProjectForm::class)->name('projects.create');
    Route::get('/projects/{project}/edit', \App\Livewire\Admin\ProjectForm::class)->name('projects.edit');
    Route::get('/posts', \App\Livewire\Admin\PostList::class)->name('posts.index');
    Route::get('/posts/create', \App\Livewire\Admin\PostForm::class)->name('posts.create');
    Route::get('/posts/{post}/edit', \App\Livewire\Admin\PostForm::class)->name('posts.edit');
});

require __DIR__.'/auth.php';
