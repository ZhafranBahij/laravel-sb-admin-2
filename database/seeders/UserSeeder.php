<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $kirakira = User::create([
            'name' => 'kirakira4141',
            'last_name' => 'kira',
            'password' => 'kirakira4141',
            'email' => 'kirakira4141@gmail.com',
        ]);
        $kirakira->assignRole('true admin');

        $admin = User::create([
            'name' => 'admin',
            'last_name' => 'admin',
            'password' => 'admin1234',
            'email' => 'admin@gmail.com',
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'user',
            'last_name' => 'user',
            'password' => 'user1234',
            'email' => 'user@gmail.com',
        ]);
        $user->assignRole('user');

        User::factory()
            ->count(10)
            ->create();
    }
}
