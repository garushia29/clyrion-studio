<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

/**
 * Controller: ProjectController
 *
 * Controlador público para el portafolio. Lista proyectos
 * publicados y muestra detalle individual.
 */
class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::published()
            ->orderBy('sort_order')
            ->orderByDesc('year')
            ->get();

        return view('pages.projects', compact('projects'));
    }

    public function show(string $slug): View
    {
        $project = Project::published()->where('slug', $slug)->firstOrFail();

        return view('pages.project-detail', compact('project'));
    }
}
