<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Artisan::call('shield:super-admin', ['--user' => $user->id]);

        Artisan::call('make:filament-user', [
            '--name' => 'Administrador',
            '--email' => 'filamentuser@example.com',
            '--password' => 'password123'
        ]);
    }
}
