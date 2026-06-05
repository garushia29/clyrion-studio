<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Project;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Tutorial;
use App\Models\TutorialSeries;
use App\Models\Service;
use App\Models\Webhook;
use App\Models\Redirect;
use App\Models\ContentBlock;
use App\Models\Export;
use App\Models\Import;
use App\Models\ActivityLog;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmokeTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $regular;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);

        $this->admin = User::factory()->create(['name' => 'Admin', 'email' => 'admin@test.com', 'role' => 'admin']);
        $this->admin->assignRole('super-admin');

        $this->regular = User::factory()->create(['name' => 'User', 'email' => 'user@test.com', 'role' => 'user']);
        $this->regular->assignRole('user');
    }

    public function test_public_pages_return_200(): void
    {
        foreach (['/', '/about', '/blog', '/projects', '/tutorials'] as $page) {
            $this->get($page)->assertStatus(200);
        }
    }

    public function test_auth_pages_return_200(): void
    {
        $this->get('/login')->assertStatus(200);
        $this->get('/register')->assertStatus(200);
    }

    public function test_seo_endpoints(): void
    {
        $this->get('/sitemap.xml')->assertStatus(200)->assertHeader('Content-Type', 'application/xml');
        $this->get('/robots.txt')->assertStatus(200);
        $this->get('/blog/feed.xml')->assertStatus(200);
    }

    public function test_admin_requires_auth(): void
    {
        $this->get('/admin/dashboard')->assertRedirect('/login');
    }

    public function test_admin_forbidden_for_regular_user(): void
    {
        $this->actingAs($this->regular)->get('/admin/dashboard')->assertStatus(403);
    }

    public function test_admin_dashboard_works(): void
    {
        $this->actingAs($this->admin)->get('/admin/dashboard')->assertStatus(200);
    }

    public function test_all_admin_pages_return_200(): void
    {
        $pages = [
            '/admin/dashboard', '/admin/projects', '/admin/projects/create',
            '/admin/posts', '/admin/posts/create',
            '/admin/categories', '/admin/categories/create',
            '/admin/tags', '/admin/tags/create',
            '/admin/users', '/admin/users/create',
            '/admin/tutorials', '/admin/tutorials/create',
            '/admin/tutorials/series', '/admin/tutorials/series/create',
            '/admin/messages', '/admin/media', '/admin/services', '/admin/services/create',
            '/admin/analytics', '/admin/blocks', '/admin/seo',
            '/admin/roles', '/admin/roles/create',
            '/admin/permissions', '/admin/permissions/create',
            '/admin/notifications', '/admin/activity', '/admin/redirects',
            '/admin/webhooks', '/admin/exports', '/admin/imports',
        ];

        foreach ($pages as $page) {
            $this->actingAs($this->admin)->get($page)->assertStatus(200);
        }
    }

    public function test_project_crud(): void
    {
        $this->actingAs($this->admin);
        $project = Project::factory()->create(['title' => 'Test Project', 'slug' => 'test-project', 'status' => 'published']);
        $this->assertModelExists($project);
        $this->get('/projects')->assertStatus(200);
        $this->get('/projects/test-project')->assertStatus(200);
        $this->get("/admin/projects/{$project->id}/edit")->assertStatus(200);
    }

    public function test_blog_crud(): void
    {
        $this->actingAs($this->admin);
        $category = Category::factory()->create(['name' => 'Test Cat']);
        $tag = Tag::factory()->create(['name' => 'Test Tag']);
        $post = Post::factory()->create(['title' => 'Test Post', 'slug' => 'test-post', 'status' => 'published']);
        $post->categories()->attach($category);
        $post->tagsRelation()->attach($tag);
        $this->assertModelExists($post);
        $this->get('/blog')->assertStatus(200);
        $this->get('/blog/test-post')->assertStatus(200);
        $this->get("/admin/posts/{$post->id}/edit")->assertStatus(200);
    }

    public function test_tutorial_crud(): void
    {
        $this->actingAs($this->admin);
        $series = TutorialSeries::factory()->create(['title' => 'Test Series', 'slug' => 'test-series']);
        $tutorial = Tutorial::factory()->create(['title' => 'Test Tutorial', 'slug' => 'test-tutorial', 'status' => 'published', 'series_id' => $series->id]);
        $this->assertModelExists($series);
        $this->assertModelExists($tutorial);
        $this->get('/tutorials')->assertStatus(200);
        $this->get('/tutorials/test-tutorial')->assertStatus(200);
    }

    public function test_services_and_blocks(): void
    {
        $this->actingAs($this->admin);
        $service = Service::factory()->create(['title' => 'Test Service', 'slug' => 'test-service', 'is_active' => true]);
        $block = ContentBlock::factory()->create(['key' => 'test-block', 'content' => ['key' => 'value'], 'is_active' => true]);
        $this->assertModelExists($service);
        $this->assertModelExists($block);
    }

    public function test_webhook_crud(): void
    {
        $this->actingAs($this->admin);
        $webhook = Webhook::create(['name' => 'Test', 'url' => 'https://example.com/hook', 'events' => 'post.created', 'is_active' => true]);
        $this->assertModelExists($webhook);
        $this->assertTrue($webhook->shouldFire('post.created'));
        $this->assertFalse($webhook->shouldFire('project.created'));
        $webhook->update(['is_active' => false]);
        $this->assertFalse($webhook->fresh()->shouldFire('post.created'));
    }

    public function test_redirect_crud(): void
    {
        $this->actingAs($this->admin);
        $redirect = Redirect::create(['old_url' => 'old-page', 'new_url' => '/new-page', 'status_code' => 301, 'is_active' => true]);
        $this->assertModelExists($redirect);
        $found = Redirect::findByOldUrl('old-page');
        $this->assertNotNull($found);
        $this->assertEquals('/new-page', $found->new_url);
    }

    public function test_roles_and_permissions(): void
    {
        $this->actingAs($this->admin);
        $role = Role::create(['name' => 'editor']);
        $permission = Permission::create(['name' => 'edit articles']);
        $role->givePermissionTo($permission);
        $this->assertTrue($role->hasPermissionTo('edit articles'));
        $this->assertTrue($this->admin->hasRole('super-admin'));
    }

    public function test_user_registration(): void
    {
        $this->post('/register', [
            'name' => 'New User', 'email' => 'new@test.com',
            'password' => 'password', 'password_confirmation' => 'password',
        ])->assertRedirect('/admin/dashboard');
        $this->assertDatabaseHas('users', ['email' => 'new@test.com']);
    }

    public function test_api_endpoints(): void
    {
        $this->getJson('/api/posts')->assertStatus(200);
        $this->getJson('/api/projects')->assertStatus(200);
        $this->getJson('/api/tutorials')->assertStatus(200);
        $this->getJson('/api/categories')->assertStatus(200);
        $this->getJson('/api/tags')->assertStatus(200);

        $response = $this->postJson('/api/login', ['email' => $this->admin->email, 'password' => 'password']);
        $response->assertStatus(200)->assertJsonStructure(['token', 'user']);
        $token = $response->json('token');

        $this->withHeaders(['Authorization' => "Bearer $token"])
            ->getJson('/api/user')->assertStatus(200);
    }

    public function test_activity_log(): void
    {
        $this->actingAs($this->admin);
        $log = ActivityLog::create([
            'user_id' => $this->admin->id, 'log_type' => 'created',
            'model_type' => 'Post', 'model_id' => 1,
            'description' => 'Test activity', 'properties' => [],
            'ip_address' => '127.0.0.1',
        ]);
        $this->assertModelExists($log);
        $this->get('/admin/activity')->assertStatus(200);
        $this->get('/admin/notifications')->assertStatus(200);
    }

    public function test_export_and_import(): void
    {
        $this->actingAs($this->admin);
        $export = Export::create(['model_type' => 'posts', 'file_type' => 'csv', 'status' => 'completed', 'user_id' => $this->admin->id]);
        $import = Import::create(['model_type' => 'posts', 'file_name' => 'test.csv', 'file_path' => 'imports/test.csv', 'status' => 'completed', 'total_rows' => 5, 'processed_rows' => 5, 'user_id' => $this->admin->id]);
        $this->assertModelExists($export);
        $this->assertModelExists($import);
    }

    public function test_locale_switching(): void
    {
        $this->get('/locale/es')->assertRedirect();
        $this->get('/locale/en')->assertRedirect();
    }
}
