<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tutorial;
use App\Models\TutorialSeries;
use Illuminate\Http\JsonResponse;

class TutorialController extends Controller
{
    public function index(): JsonResponse
    {
        $tutorials = Tutorial::with('series')
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(15);

        return response()->json($tutorials);
    }

    public function show(string $slug): JsonResponse
    {
        $tutorial = Tutorial::with('series')
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        return response()->json($tutorial);
    }

    public function series(string $slug): JsonResponse
    {
        $series = TutorialSeries::where('slug', $slug)
            ->with(['tutorials' => function ($q) {
                $q->published()->orderBy('sort_order');
            }])
            ->firstOrFail();

        return response()->json($series);
    }
}
