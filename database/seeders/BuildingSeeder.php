<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buildings = [
            [
                'name' => 'Office',
                'phone' => '9999999',
                'address' => 'Pare Kediri',
                'owner' => 'JBI',
                'status' => 1,
                'company_id' => 1,
            ],
            [
                'name' => 'New Building',
                'phone' => '9999999',
                'address' => 'Pare Kediri',
                'owner' => 'LC',
                'status' => 1,
                'company_id' => 2,
            ],
            [
                'name' => 'West Forest',
                'phone' => '9999999',
                'address' => 'Pare Kediri',
                'owner' => 'LC',
                'status' => 1,
                'company_id' => 2,
            ],
            [
                'name' => 'Office',
                'phone' => '9999999',
                'address' => 'Pare Kediri',
                'owner' => 'JB',
                'status' => 1,
                'company_id' => 3,
            ],
            [
                'name' => 'Studio',
                'phone' => '9999999',
                'address' => 'Pare Kediri',
                'owner' => 'JB',
                'status' => 1,
                'company_id' => 3,
            ],
            [
                'name' => 'Masjid',
                'phone' => '9999999',
                'address' => 'Pare Kediri',
                'owner' => 'AN Najah',
                'status' => 1,
                'company_id' => 4,
            ],
            [
                'name' => 'Office',
                'phone' => '9999999',
                'address' => 'Pare Kediri',
                'owner' => 'AN Najah',
                'status' => 1,
                'company_id' => 4,
            ]
        ];

        Building::insert($buildings);
    }
}
