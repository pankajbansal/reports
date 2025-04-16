<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Pankaj Bansal',
                'email' => 'pankaj@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Anita Sharma',
                'email' => 'anita@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Rahul Mehta',
                'email' => 'rahul@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
