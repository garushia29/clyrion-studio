<?php

namespace App\Livewire\Admin;

use App\Models\PageView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Analytics extends AdminComponent
{
    public int $days = 30;
    public string $startDate = '';
    public string $endDate = '';

    public function mount(): void
    {
        $this->startDate = now()->subDays($this->days)->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }

    public function updatedDays(): void
    {
        $this->startDate = now()->subDays($this->days)->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }

    public function filterByDate(): void
    {
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);
    }

    protected function view(): View
    {
        $start = $this->startDate ? Carbon::parse($this->startDate) : now()->subDays(30);
        $end = $this->endDate ? Carbon::parse($this->endDate) : now();

        $totalViews = PageView::whereBetween('created_at', [$start, $end])->count();
        $todayViews = PageView::whereDate('created_at', today())->count();
        $uniqueVisitors = PageView::whereBetween('created_at', [$start, $end])->distinct('visitor_id')->count('visitor_id');
        $topPages = PageView::topPagesByRange(10, $start, $end);
        $viewsByDay = PageView::viewsByDayRange($start, $end);
        $maxDaily = collect($viewsByDay)->max('visits') ?: 1;

        return view('livewire.admin.analytics', compact(
            'totalViews', 'todayViews', 'uniqueVisitors',
            'topPages', 'viewsByDay', 'maxDaily', 'start', 'end'
        ));
    }

    public function exportCsv(): StreamedResponse
    {
        $start = $this->startDate ? Carbon::parse($this->startDate) : now()->subDays(30);
        $end = $this->endDate ? Carbon::parse($this->endDate) : now();

        $rows = PageView::whereBetween('created_at', [$start, $end])
            ->select('path', 'referer', 'user_agent', 'ip_address', 'created_at')
            ->orderByDesc('created_at')
            ->cursor();

        return response()->streamDownload(function () use ($rows) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Path', 'Referer', 'User Agent', 'IP', 'Date']);

            foreach ($rows as $row) {
                fputcsv($handle, [
                    $row->path,
                    $row->referer ?? '',
                    $row->user_agent ?? '',
                    $row->ip_address ?? '',
                    $row->created_at?->toDateTimeString() ?? '',
                ]);
            }

            fclose($handle);
        }, "analytics-{$start->format('Y-m-d')}-{$end->format('Y-m-d')}.csv", [
            'Content-Type' => 'text/csv',
        ]);
    }
}
