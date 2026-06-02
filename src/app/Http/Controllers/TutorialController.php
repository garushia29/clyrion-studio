<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use App\Models\TutorialSeries;
use Illuminate\View\View;

/**
 * Controller: TutorialController
 *
 * Controlador público para tutoriales. Lista series y tutoriales
 * independientes, muestra detalle con navegación entre tutoriales
 * de una misma serie.
 */
class TutorialController extends Controller
{
    public function index(): View
    {
        $series = TutorialSeries::active()
            ->withCount('tutorials')
            ->orderBy('sort_order')
            ->get();

        $standalone = Tutorial::published()
            ->whereNull('series_id')
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('pages.tutorials', compact('series', 'standalone'));
    }

    public function show(string $slug): View
    {
        $tutorial = Tutorial::published()->where('slug', $slug)->firstOrFail();

        $series = null;
        $prev = null;
        $next = null;

        if ($tutorial->series) {
            $series = $tutorial->series;
            $ordered = $series->tutorials()->published()->get();
            $currentIndex = $ordered->search(fn($t) => $t->id === $tutorial->id);
            if ($currentIndex !== false) {
                $prev = $ordered->get($currentIndex - 1);
                $next = $ordered->get($currentIndex + 1);
            }
        }

        $related = Tutorial::published()
            ->where('id', '!=', $tutorial->id)
            ->where('difficulty', $tutorial->difficulty)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('pages.tutorial-detail', compact('tutorial', 'series', 'prev', 'next', 'related'));
    }

    public function series(string $slug): View
    {
        $series = TutorialSeries::where('slug', $slug)->firstOrFail();
        $tutorials = $series->tutorials()->published()->get();

        return view('pages.tutorial-series', compact('series', 'tutorials'));
    }
}
