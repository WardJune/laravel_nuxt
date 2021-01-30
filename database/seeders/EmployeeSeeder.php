<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'name' => 'Warda Rifjunanto',
            'date_of_birth' => '2002-06-14',
            'job_title' => 'Direktur',
            'profiles' => []
        ]);
    }
}
