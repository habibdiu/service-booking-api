<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
          'name' => 'Admin User',
          'email' => 'admin@gmail.com',
          'password' => bcrypt('123456'),
          'is_admin' => true, // if you use this column for admin flag
        ]);
        Service::factory()->count(5)->create();
    }
}
