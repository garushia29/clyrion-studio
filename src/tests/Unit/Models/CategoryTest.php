<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_category(): void
    {
        $category = Category::factory()->create(['name' => 'Tutorials']);

        $this->assertModelExists($category);
        $this->assertEquals('Tutorials', $category->name);
    }

    public function test_auto_generates_slug(): void
    {
        $category = Category::factory()->create(['name' => 'Laravel Tips', 'slug' => '']);

        $this->assertEquals('laravel-tips', $category->slug);
    }

    public function test_has_posts_relationship(): void
    {
        $category = Category::factory()->create();
        $post = Post::factory()->create();

        $category->posts()->attach($post);

        $this->assertTrue($category->posts->contains($post));
    }

    public function test_has_parent_and_children(): void
    {
        $parent = Category::factory()->create(['name' => 'Parent']);
        $child = Category::factory()->create(['name' => 'Child', 'parent_id' => $parent->id]);

        $this->assertTrue($parent->children->contains($child));
        $this->assertEquals($parent->id, $child->parent->id);
    }
}
