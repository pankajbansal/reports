<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_activities')->insert([
            [
                'user_id' => 1,
                'activity_name' => 'Login',
                'description' => 'User logged into the system',
                'created_at' => Carbon::now(),
                'ip_address' => '192.168.1.10',
            ],
            [
                'user_id' => 1,
                'activity_name' => 'Profile Update',
                'description' => 'User updated profile details',
                'created_at' => Carbon::now(),
                'ip_address' => '192.168.1.10',
            ],
            [
                'user_id' => 2,
                'activity_name' => 'Password Reset',
                'description' => 'User reset their password',
                'created_at' => Carbon::now(),
                'ip_address' => '192.168.1.11',
            ],
            [
                'user_id' => 3,
                'activity_name' => 'Login',
                'description' => 'User logged into the system',
                'created_at' => Carbon::now(),
                'ip_address' => '192.168.1.12',
            ],
        ]);
    }
}
