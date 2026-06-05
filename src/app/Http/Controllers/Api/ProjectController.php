<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = Project::orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json($projects);
    }

    public function show(string $slug): JsonResponse
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        return response()->json($project);
    }

    public function featured(): JsonResponse
    {
        $projects = Project::where('is_featured', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json($projects);
    }
}
