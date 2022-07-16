<?php

namespace Database\Seeders;

// use DB;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'Admin@123',
            'fullname' => 'admin',
            'role' => 'admin',
            'status' => STATUS_ACTIVE
        ]);

        $user = User::create([
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => 'User@123',
            'fullname' => 'User',
            'role' => 'user',
            'status' => STATUS_ACTIVE
        ]);

        $fake  = \Faker\Factory::create();
        $limit = 50;

        for ($i = 0; $i < $limit; $i++){
            DB::table('users')->insert([
                'username' => $fake->userName,
                'password' => $fake-> password,
                'email' => $fake->unique->email,
                'fullname' => $fake-> name,
                'role' => 'user',
                'status' => STATUS_ACTIVE,
                'remember_token' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }

    }
}
