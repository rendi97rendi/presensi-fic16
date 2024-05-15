<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Permission;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'administrator@example.com',
            'password' => Hash::make('passlogin'),
        ]);

        User::factory()->create([
            'name' => 'Rendi',
            'email' => 'rendi@example.com',
            'password' => Hash::make('passlogin'),
        ]);
        User::factory(10)->create();
        Attendance::factory(20)->create();
        Permission::factory(20)->create();
    }
}
