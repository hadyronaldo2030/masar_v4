<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Drop Data
        DB::table('users')->delete();

        //  Insert User
        DB::table('users')->insert([
            'name' => 'Mohamed Mado',
            'age' => '1999-07-18', 
            'email' => 'mado@gmail.com',
            'password' => Hash::make('mado13591'),
            'role' => 'admin',
            'mobile' => '01150636689',
            'address' => 'Cairo, Egypt',
            'jobTitle' => 'Software Developer',
            'salary' => 150000,
            'department' => 'programming',
            'status' => 'permanent',
            'gender' => 'male',
            'image' => 'IMG-20210527-WA0077.jpg',
            'image2' => '1Egyption_ID.jpg',
            'image3' => 'Egyption_ID.jpg',
            'creator_name' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
