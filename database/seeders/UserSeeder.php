<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ward June',
            'username' => 'june',
            'email' => 'junawar183@gmail.com',
            'password' => bcrypt('password'),
            'employee_id' => 1
        ]);
    }
}
