<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => 'email@gmail.com',
                'phone' => '1234567890',
                'address' => '123 Main St',
                'city' => 'New York',
                'path' => 'avatarUser.png',
                'password' => md5('123456'),
                'role_id' => 2
            ],
            [
                'firstname' => 'Jane',
                'lastname' => 'Doe',
                'email' => 'exampe@gmail.com',
                'phone' => '0987654321',
                'address' => '456 Main St',
                'city' => 'Los Angeles',
                'path' => 'avatarUser.png',
                'password' => md5('123456'),
                'role_id' => 2
            ],
            [
                'firstname' => 'Zemo',
                'lastname' => 'Doe',
                'email' => 'example@gmail.com',
                'phone' => '065565656',
                'address' => '456 Main St',
                'city' => 'Los Angeles',
                'path' => 'avatarUser.png',
                'password' => md5('123456'),
                'role_id' => 1
            ],

        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);

        }

    }
}
