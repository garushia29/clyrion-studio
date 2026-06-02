<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_scope(): void
    {
        Post::factory()->create(['status' => 'draft', 'published_at' => null]);
        Post::factory()->create(['status' => 'published', 'published_at' => now()]);

        $published = Post::published()->get();

        $this->assertCount(1, $published);
    }

    public function test_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($post->user->is($user));
    }

    public function test_reading_time_returns_minutes(): void
    {
        $post = Post::factory()->create(['content' => implode(' ', array_fill(0, 400, 'word'))]);

        $this->assertStringContainsString('min', $post->readingTime());
    }
}
