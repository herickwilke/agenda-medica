<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$14yhHChlHF7QqqsucYQbYeerXp8EnF7zUxdOBkb34mzJMqcuH/43u',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
