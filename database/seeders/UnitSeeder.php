<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $units = [
            [
                'name' => 'Pcs'
            ],
            [
                'name' => 'Eksemplar'
            ],
            [
                'name' => 'Unit'
            ],
            [
                'name' => 'Rim'
            ],
            [
                'name' => 'Box'
            ],
            [
                'name' => 'Pack'
            ],
            [
                'name' => 'Set'
            ],
        ];

        Unit::insert($units);
    }
}
