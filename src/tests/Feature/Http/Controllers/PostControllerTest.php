<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_shows_published_posts(): void
    {
        Post::factory()->create(['status' => 'published', 'published_at' => now()]);
        Post::factory()->create(['status' => 'draft']);

        $response = $this->get(route('blog.index'));

        $response->assertOk();
        $response->assertViewHas('posts');
        $this->assertEquals(1, $response->viewData('posts')->total());
    }

    public function test_show_displays_post(): void
    {
        $post = Post::factory()->create(['status' => 'published', 'published_at' => now()]);

        $response = $this->get(route('blog.show', $post->slug));

        $response->assertOk();
        $response->assertViewHas('post');
    }

    public function test_show_404_for_draft_post(): void
    {
        $post = Post::factory()->create(['status' => 'draft']);

        $response = $this->get(route('blog.show', $post->slug));

        $response->assertNotFound();
    }

    public function test_category_filter(): void
    {
        $category = Category::factory()->create();
        $post = Post::factory()->create(['status' => 'published', 'published_at' => now()]);
        $post->categories()->attach($category);

        $response = $this->get(route('blog.category', $category->slug));

        $response->assertOk();
    }

    public function test_tag_filter(): void
    {
        $tag = Tag::factory()->create();
        $post = Post::factory()->create(['status' => 'published', 'published_at' => now()]);

        $response = $this->get(route('blog.tag', $tag->slug));

        $response->assertOk();
    }

    public function test_feed_returns_xml(): void
    {
        Post::factory()->count(3)->create(['status' => 'published', 'published_at' => now()]);

        $response = $this->get(route('blog.feed'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/xml');
    }
}
