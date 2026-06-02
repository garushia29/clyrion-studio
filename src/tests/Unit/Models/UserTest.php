<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_is_admin_returns_true_for_admin_role(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->assertTrue($admin->isAdmin());
    }

    public function test_is_admin_returns_false_for_user_role(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->assertFalse($user->isAdmin());
    }

    public function test_admins_scope(): void
    {
        User::factory()->create(['role' => 'admin']);
        User::factory()->count(2)->create(['role' => 'user']);

        $this->assertCount(1, User::admins()->get());
    }

    public function test_regular_scope(): void
    {
        User::factory()->count(2)->create(['role' => 'user']);
        User::factory()->create(['role' => 'admin']);

        $this->assertCount(2, User::regular()->get());
    }
}
