<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TutorialController;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\CategoryList;
use App\Livewire\Admin\CategoryForm;
use App\Livewire\Admin\TagList;
use App\Livewire\Admin\TagForm;
use App\Livewire\Admin\ContentBlockManager;
use App\Livewire\Admin\PermissionForm;
use App\Livewire\Admin\PermissionList;
use App\Livewire\Admin\RoleForm;
use App\Livewire\Admin\RoleList;
use App\Livewire\Admin\NotificationList;
use App\Livewire\Admin\ActivityLogList;
use Illuminate\Support\Facades\Route;

// Public pages
Route::get('/', function () {
    $featured = \App\Models\Project::featured()->orderBy('sort_order')->take(3)->get();
    $services = \App\Models\Service::active()->orderBy('sort_order')->get();
    return view('pages.home', compact('featured', 'services'));
})->name('home');
Route::view('/about', 'pages.about')->name('about');

// Project portfolio
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

// Tutorial platform
Route::prefix('tutorials')->name('tutorials.')->group(function () {
    Route::get('/', [TutorialController::class, 'index'])->name('index');
    Route::get('/series/{slug}', [TutorialController::class, 'series'])->name('series');
    Route::get('/{slug}', [TutorialController::class, 'show'])->name('show');
});

// Blog system
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/category/{slug}', [PostController::class, 'category'])->name('category');
    Route::get('/tag/{slug}', [PostController::class, 'tag'])->name('tag');
    Route::get('/feed.xml', [PostController::class, 'feed'])->name('feed');
    Route::get('/{slug}', [PostController::class, 'show'])->name('show');
});

// Enhanced XML sitemap with image support, lastmod, and hreflang
Route::get('/sitemap.xml', function () {
    $latestPost = \App\Models\Post::published()->latest('updated_at')->value('updated_at');
    $latestProject = \App\Models\Project::published()->latest('updated_at')->value('updated_at');
    $latestTutorial = \App\Models\Tutorial::published()->latest('updated_at')->value('updated_at');
    $latestContent = collect([$latestPost, $latestProject, $latestTutorial])->filter()->max();

    $urls = collect([
        ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'weekly', 'lastmod' => $latestContent?->toDateString()],
        ['loc' => url('/about'), 'priority' => '0.9', 'changefreq' => 'monthly'],
        ['loc' => url('/projects'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $latestProject?->toDateString()],
        ['loc' => url('/blog'), 'priority' => '0.7', 'changefreq' => 'weekly', 'lastmod' => $latestPost?->toDateString()],
        ['loc' => url('/tutorials'), 'priority' => '0.7', 'changefreq' => 'weekly', 'lastmod' => $latestTutorial?->toDateString()],
    ]);

    $categories = \App\Models\Category::whereHas('posts', fn($q) => $q->published())->get(['slug', 'updated_at']);
    foreach ($categories as $cat) {
        $urls->push(['loc' => route('blog.category', $cat->slug), 'priority' => '0.5', 'changefreq' => 'weekly', 'lastmod' => $cat->updated_at->toDateString()]);
    }

    $projects = \App\Models\Project::published()->get(['slug', 'updated_at', 'featured_image']);
    foreach ($projects as $project) {
        $entry = [
            'loc' => route('projects.show', $project->slug),
            'priority' => '0.6',
            'changefreq' => 'monthly',
            'lastmod' => $project->updated_at->toDateString(),
        ];
        if ($project->featured_image) {
            $entry['images'][] = $project->featured_image;
        }
        $urls->push($entry);
    }

    $posts = \App\Models\Post::published()->get(['slug', 'updated_at', 'featured_image']);
    foreach ($posts as $post) {
        $entry = [
            'loc' => route('blog.show', $post->slug),
            'priority' => '0.6',
            'changefreq' => 'monthly',
            'lastmod' => $post->updated_at->toDateString(),
        ];
        if ($post->featured_image) {
            $entry['images'][] = $post->featured_image;
        }
        $urls->push($entry);
    }

    $tutorialSeries = \App\Models\TutorialSeries::whereHas('tutorials', fn($q) => $q->published())->get(['slug', 'updated_at']);
    foreach ($tutorialSeries as $series) {
        $urls->push(['loc' => route('tutorials.series', $series->slug), 'priority' => '0.5', 'changefreq' => 'monthly', 'lastmod' => $series->updated_at->toDateString()]);
    }

    $tutorials = \App\Models\Tutorial::published()->get(['slug', 'updated_at']);
    foreach ($tutorials as $tutorial) {
        $urls->push(['loc' => route('tutorials.show', $tutorial->slug), 'priority' => '0.6', 'changefreq' => 'monthly', 'lastmod' => $tutorial->updated_at->toDateString()]);
    }

    return response()->view('sitemap', ['urls' => $urls])->header('Content-Type', 'application/xml');
});

// Dynamic robots.txt
Route::get('/robots.txt', function () {
    return response()->view('robots', status: 200)->header('Content-Type', 'text/plain');
});

// User profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin panel — all CRUD operations for content management
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', App\Livewire\Admin\Dashboard::class)->name('dashboard');

    // Project management
    Route::get('/projects', \App\Livewire\Admin\ProjectList::class)->name('projects.index');
    Route::get('/projects/create', \App\Livewire\Admin\ProjectForm::class)->name('projects.create');
    Route::get('/projects/{project}/edit', \App\Livewire\Admin\ProjectForm::class)->name('projects.edit');

    // Blog post management
    Route::get('/posts', \App\Livewire\Admin\PostList::class)->name('posts.index');
    Route::get('/posts/create', \App\Livewire\Admin\PostForm::class)->name('posts.create');
    Route::get('/posts/{post}/edit', \App\Livewire\Admin\PostForm::class)->name('posts.edit');

    // Category management
    Route::get('/categories', CategoryList::class)->name('categories.index');
    Route::get('/categories/create', CategoryForm::class)->name('categories.create');
    Route::get('/categories/{category}/edit', CategoryForm::class)->name('categories.edit');

    // Tag management
    Route::get('/tags', TagList::class)->name('tags.index');
    Route::get('/tags/create', TagForm::class)->name('tags.create');
    Route::get('/tags/{tag}/edit', TagForm::class)->name('tags.edit');

    // User management
    Route::get('/users', \App\Livewire\Admin\UserList::class)->name('users.index');
    Route::get('/users/create', \App\Livewire\Admin\UserForm::class)->name('users.create');
    Route::get('/users/{user}/edit', \App\Livewire\Admin\UserForm::class)->name('users.edit');

    // Tutorial management
    Route::get('/tutorials', \App\Livewire\Admin\TutorialList::class)->name('tutorials.index');
    Route::get('/tutorials/create', \App\Livewire\Admin\TutorialForm::class)->name('tutorials.create');
    Route::get('/tutorials/{tutorial}/edit', \App\Livewire\Admin\TutorialForm::class)->name('tutorials.edit');
    Route::get('/tutorials/series', \App\Livewire\Admin\TutorialSeriesList::class)->name('series.index');
    Route::get('/tutorials/series/create', \App\Livewire\Admin\TutorialSeriesForm::class)->name('series.create');
    Route::get('/tutorials/series/{series}/edit', \App\Livewire\Admin\TutorialSeriesForm::class)->name('series.edit');

    // Contact messages
    Route::get('/messages', \App\Livewire\Admin\ContactMessageList::class)->name('messages.index');

    // Media library
    Route::get('/media', \App\Livewire\Admin\MediaLibrary::class)->name('media.index');
    Route::post('/media/upload-trix', [\App\Http\Controllers\Admin\MediaController::class, 'uploadTrix'])->name('media.upload-trix');

    // Services management (Phase 11 - CRUD dinámico para homepage)
    Route::get('/services', \App\Livewire\Admin\ServiceList::class)->name('services.index');
    Route::get('/services/create', \App\Livewire\Admin\ServiceForm::class)->name('services.create');
    Route::get('/services/{service}/edit', \App\Livewire\Admin\ServiceForm::class)->name('services.edit');

    // Analytics dashboard
    Route::get('/analytics', \App\Livewire\Admin\Analytics::class)->name('analytics.index');

    // Content blocks (dynamic homepage sections)
    Route::get('/blocks', ContentBlockManager::class)->name('blocks.index');

    // Centralized SEO settings
    Route::get('/seo', \App\Livewire\Admin\SeoSettings::class)->name('seo.index');

    // Role management
    Route::get('/roles', RoleList::class)->name('roles.index');
    Route::get('/roles/create', RoleForm::class)->name('roles.create');
    Route::get('/roles/{role}/edit', RoleForm::class)->name('roles.edit');

    // Permission management
    Route::get('/permissions', PermissionList::class)->name('permissions.index');
    Route::get('/permissions/create', PermissionForm::class)->name('permissions.create');
    Route::get('/permissions/{permission}/edit', PermissionForm::class)->name('permissions.edit');

    // Notifications
    Route::get('/notifications', NotificationList::class)->name('notifications.index');

    // Activity log
    Route::get('/activity', ActivityLogList::class)->name('activity.index');

    // Redirect manager
    Route::get('/redirects', \App\Livewire\Admin\RedirectList::class)->name('redirects.index');

    // Webhooks
    Route::get('/webhooks', \App\Livewire\Admin\WebhookList::class)->name('webhooks.index');

    // Exports
    Route::get('/exports', \App\Livewire\Admin\ExportManager::class)->name('exports.index');

    // Imports
    Route::get('/imports', \App\Livewire\Admin\ImportManager::class)->name('imports.index');
});

// Locale switcher
Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['es', 'en'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('locale.switch');

require __DIR__.'/auth.php';
