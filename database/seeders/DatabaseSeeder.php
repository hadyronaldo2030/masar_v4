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

        // $users = \App\Models\User::factory(100)->create();

    //    if ($users->count() > 0) {
           \App\Models\Attendance::factory(10)->create(['employee_id' => $users->random()]);
    //    }
    }
}
