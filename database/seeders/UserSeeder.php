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

        $true_admin = Role::create(['name' => 'true admin']);
        $kirakira->assignRole('true admin');

        User::factory()
            ->count(10)
            ->create();
    }
}
