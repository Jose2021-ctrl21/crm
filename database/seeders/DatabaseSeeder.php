<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Companies;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // for user
        User::create([
            'email' => 'admin@admin.com',
            'password' => 'password',
            'name' => 'Jose Manuel'
        ]);

        // for company
        // Companies::factory(100)->create();

        // for employee
        // \App\Models\Employees::factory(10)->create();

    }
}
