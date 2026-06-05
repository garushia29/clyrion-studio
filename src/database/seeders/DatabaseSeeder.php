<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        $user = User::factory()->create([
            'name' => 'Jimmy Garcia Vallejos',
            'email' => 'garushia29@gmail.com',
            'password' => bcrypt('garushia'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $user->assignRole('super-admin');
    }
}
