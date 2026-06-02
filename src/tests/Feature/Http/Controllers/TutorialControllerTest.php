<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Tutorial;
use App\Models\TutorialSeries;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TutorialControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_shows_active_series_and_standalone_tutorials(): void
    {
        TutorialSeries::factory()->create(['is_active' => true]);
        Tutorial::factory()->create(['status' => 'published', 'published_at' => now(), 'series_id' => null]);

        $response = $this->get(route('tutorials.index'));

        $response->assertOk();
    }

    public function test_show_displays_tutorial(): void
    {
        $tutorial = Tutorial::factory()->create(['status' => 'published', 'published_at' => now()]);

        $response = $this->get(route('tutorials.show', $tutorial->slug));

        $response->assertOk();
        $response->assertViewHas('tutorial');
    }

    public function test_show_404_for_draft(): void
    {
        $tutorial = Tutorial::factory()->create(['status' => 'draft']);

        $response = $this->get(route('tutorials.show', $tutorial->slug));

        $response->assertNotFound();
    }

    public function test_series_shows_tutorials(): void
    {
        $series = TutorialSeries::factory()->create();
        Tutorial::factory()->count(2)->create([
            'series_id' => $series->id,
            'status' => 'published',
            'published_at' => now(),
        ]);

        $response = $this->get(route('tutorials.series', $series->slug));

        $response->assertOk();
        $response->assertViewHas('series');
        $response->assertViewHas('tutorials');
    }
}
