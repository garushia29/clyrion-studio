<?php

/**
 * Livewire Component: Analytics
 *
 * Dashboard de analytics que muestra estadísticas de visitas:
 * total de visitas, visitantes únicos, páginas más visitadas
 * y tráfico por día en los últimos 30 días.
 */
namespace App\Livewire\Admin;

use App\Models\PageView;
use Illuminate\Contracts\View\View;

class Analytics extends AdminComponent
{
    /** Rango de días para las estadísticas */
    public int $days = 30;

    protected function view(): View
    {
        $totalViews = PageView::where('created_at', '>=', now()->subDays($this->days))->count();
        $todayViews = PageView::whereDate('created_at', today())->count();
        $uniqueVisitors = PageView::uniqueVisitors($this->days);
        $topPages = PageView::topPages(10, $this->days);
        $viewsByDay = PageView::viewsByDay($this->days);
        $maxDaily = collect($viewsByDay)->max('visits') ?: 1;

        return view('livewire.admin.analytics', compact(
            'totalViews', 'todayViews', 'uniqueVisitors',
            'topPages', 'viewsByDay', 'maxDaily'
        ));
    }
}
