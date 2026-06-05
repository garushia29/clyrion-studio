<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            // Posts
            'view posts', 'create posts', 'edit posts', 'delete posts',
            // Projects
            'view projects', 'create projects', 'edit projects', 'delete projects',
            // Tutorials
            'view tutorials', 'create tutorials', 'edit tutorials', 'delete tutorials',
            // Tutorial series
            'view series', 'create series', 'edit series', 'delete series',
            // Services
            'view services', 'create services', 'edit services', 'delete services',
            // Categories
            'view categories', 'create categories', 'edit categories', 'delete categories',
            // Tags
            'view tags', 'create tags', 'edit tags', 'delete tags',
            // Users
            'view users', 'create users', 'edit users', 'delete users',
            // Media
            'view media', 'upload media', 'delete media',
            // Messages
            'view messages', 'delete messages',
            // Analytics
            'view analytics',
            // SEO
            'view seo', 'edit seo',
            // Content blocks
            'view blocks', 'create blocks', 'edit blocks', 'delete blocks',
            // Roles & Permissions
            'view roles', 'create roles', 'edit roles', 'delete roles',
            'view permissions', 'create permissions', 'edit permissions', 'delete permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());

        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
    }
}
