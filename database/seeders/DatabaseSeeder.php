<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\KriteriaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
             'name' => 'Admin',
             'username'=> 'admin',
             'email' => 'admin@gmail.com',
             'password' => \bcrypt('admin'),
             'foto' => 'user.png'
        ]);
    }
}
