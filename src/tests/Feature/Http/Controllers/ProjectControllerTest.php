<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_shows_published_projects(): void
    {
        Project::factory()->create(['status' => 'published']);
        Project::factory()->create(['status' => 'draft']);

        $response = $this->get(route('projects.index'));

        $response->assertOk();
        $this->assertCount(1, $response->viewData('projects'));
    }

    public function test_show_displays_project(): void
    {
        $project = Project::factory()->create(['status' => 'published']);

        $response = $this->get(route('projects.show', $project->slug));

        $response->assertOk();
        $response->assertViewHas('project');
    }

    public function test_show_404_for_draft_project(): void
    {
        $project = Project::factory()->create(['status' => 'draft']);

        $response = $this->get(route('projects.show', $project->slug));

        $response->assertNotFound();
    }
}
