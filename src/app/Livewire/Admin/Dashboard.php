<?php

/**
 * Livewire Component: Admin Dashboard
 *
 * Panel principal del admin con estadísticas generales del sitio:
 * conteo de entidades, posts recientes, mensajes sin leer,
 * acciones rápidas y resumen de analytics.
 */
namespace App\Livewire\Admin;

use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use App\Models\PageView;
use App\Models\ContactMessage;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Contracts\View\View;

class Dashboard extends AdminComponent
{
    protected function view(): View
    {
        return view('livewire.admin.dashboard', [
            'stats' => [
                'projects' => Project::count(),
                'posts' => Post::count(),
                'users' => User::count(),
                'categories' => Category::count(),
                'tags' => Tag::count(),
                'unreadMessages' => ContactMessage::unread()->count(),
            ],
            'recentPosts' => Post::with('user')
                ->orderByDesc('created_at')
                ->take(5)
                ->get(),
            'recentMessages' => ContactMessage::unread()
                ->orderByDesc('created_at')
                ->take(5)
                ->get(),
            'publishedProjects' => Project::published()->count(),
            'publishedPosts' => Post::published()->count(),
            'analytics' => [
                'totalViews' => PageView::where('created_at', '>=', now()->subDays(30))->count(),
                'todayViews' => PageView::whereDate('created_at', today())->count(),
                'uniqueVisitors' => PageView::uniqueVisitors(30),
            ],
        ]);
    }
}
