<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users  = [
            [
                'id'         => 1,
                'user_name'        => 'Admin',
                'email' => 'admin@cnkbkt.com',
                'email_verified_at' =>  date('Y-m-d H:i:s'),
                'password' => Hash::make("admin@1234"),
                'role_id' => config("constant.role.admin"),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'         => 2,
                'user_name'        => 'Creator',
                'email' => 'creator@cnkbkt.com',
                'email_verified_at' =>  date('Y-m-d H:i:s'),
                'password' => Hash::make("creator@1234"),
                'role_id' => config("constant.role.creator"),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id'         => 3,
                'user_name'        => 'User',
                'email' => 'user@cnkbkt.com',
                'email_verified_at' =>  date('Y-m-d H:i:s'),
                'password' => Hash::make("user@1234"),
                'role_id' => config("constant.role.user"),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        User::insert($users);
    }
}
