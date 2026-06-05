<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use App\Models\PageView;
use App\Models\ContactMessage;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

class Dashboard extends AdminComponent
{
    protected function view(): View
    {
        $viewsByDay = PageView::viewsByDay(30);
        $maxDaily = collect($viewsByDay)->max('visits') ?: 1;

        $postsByMonth = Post::where('created_at', '>=', now()->subMonths(12))
            ->get()
            ->groupBy(fn($post) => $post->created_at->format('Y-m'))
            ->map(fn($group) => $group->count());

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
            'chartLabels' => collect($viewsByDay)->pluck('date')->map(fn($d) => Carbon::parse($d)->format('d M')),
            'chartData' => collect($viewsByDay)->pluck('visits'),
            'maxDaily' => $maxDaily,
            'postChartLabels' => $postsByMonth->keys(),
            'postChartData' => $postsByMonth->values(),
        ]);
    }
}
