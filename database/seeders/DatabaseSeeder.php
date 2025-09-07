<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
        ]);

        // Always run role and permission seeder
        $this->call(RolePermissionSeeder::class);

        if (\App::environment('local')) {
            $this->call(DemoSeeder::class);
            $this->call(MemberSeeder::class);
            $this->call(UserSeeder::class);
        }
    }
}
