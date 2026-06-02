<?php

namespace Tests\Unit\Models;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_featured_scope(): void
    {
        Project::factory()->create(['featured' => true, 'status' => 'published']);
        Project::factory()->create(['featured' => false, 'status' => 'published']);
        Project::factory()->create(['featured' => true, 'status' => 'draft']);

        $featured = Project::featured()->get();

        $this->assertCount(1, $featured);
    }

    public function test_published_scope(): void
    {
        Project::factory()->create(['status' => 'published']);
        Project::factory()->create(['status' => 'draft']);

        $this->assertCount(1, Project::published()->get());
    }

    public function test_casts_technologies_as_array(): void
    {
        $project = Project::factory()->create(['technologies' => ['Laravel', 'Vue', 'Docker']]);

        $this->assertIsArray($project->technologies);
        $this->assertContains('Laravel', $project->technologies);
    }
}
