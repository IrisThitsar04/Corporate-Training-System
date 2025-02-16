<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        User::create(
            [
                'first_name' => 'Iris',
                'last_name' => 'Thitsar',
                'email' => 'iris@gmail.com',
                'username' => 'Iris',
                'password' => Hash::make('iris@1234'),
                'role' => 'admin',
            ]
        );

        User::create(
            [
                'first_name' => 'Louis',
                'last_name' => 'James',
                'email' => 'louis@gmail.com',
                'username' => 'Louis James',
                'password' => Hash::make('louis1234'),
                'role' => 'instructor',
            ]
        );

        User::create(
            [
                'first_name' => 'Lucy',
                'last_name' => 'Caludine',
                'email' => 'lucy@gmail.com',
                'username' => 'Lucy Claudine',
                'password' => Hash::make('lucy1234'),
                'role' => 'student',
            ]
        );

    }
}
