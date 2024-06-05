<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => '1',
            'name' => '管理者太郎',
            'email' => 'test1@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('11111111'),
        ]);
        User::create([
            'role_id' => '1',
            'name' => '利用者次郎',
            'email' => 'test2@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('22222222'),
        ]);
    }
}
