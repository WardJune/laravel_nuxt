<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perusahaan = Unit::create([
            'name' => 'Perusahaan C'
        ]);

        $hrd = Unit::create([
            "name" => "Direksi HRD",
            "parent_unit_id" => $perusahaan->id
        ]);

        Unit::create([
            "name" => "Bagian Human Resource",
            "parent_unit_id" => $hrd->id
        ]);

        Unit::create([
            "name" => "Bagian Career Development",
            "parent_unit_id" => $hrd->id
        ]);
    }
}
