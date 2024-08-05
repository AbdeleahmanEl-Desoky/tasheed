<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Suber Admin',
            'email' => 'admin@admin.com',
            'phone'=> '01200816003',
            'password' => bcrypt('12345678'),
        ]);

         $user->addRole('superadmin');
    }
}
