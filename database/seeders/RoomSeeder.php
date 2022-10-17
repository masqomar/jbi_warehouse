<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            [
                'name' => 'Front Office',
                'status' => 1,
                'building_id' => 1,
                'company_id' => 1,
            ],
            [
                'name' => 'Front Office',
                'status' => 1,
                'building_id' => 2,
                'company_id' => 2,
            ],
            [
                'name' => 'Accounting Room',
                'status' => 1,
                'building_id' => 2,
                'company_id' => 2,
            ],
            [
                'name' => 'Operational Room',
                'status' => 1,
                'building_id' => 2,
                'company_id' => 2,
            ],
            [
                'name' => 'Academic Room',
                'status' => 1,
                'building_id' => 2,
                'company_id' => 2,
            ],
            [
                'name' => 'Teachers Room',
                'status' => 1,
                'building_id' => 2,
                'company_id' => 2,
            ],
            [
                'name' => 'Camp Team Room',
                'status' => 1,
                'building_id' => 2,
                'company_id' => 2,
            ],
            [
                'name' => 'Security',
                'status' => 1,
                'building_id' => 2,
                'company_id' => 2,
            ],
            [
                'name' => 'Studio',
                'status' => 1,
                'building_id' => 2,
                'company_id' => 2,
            ]
        ];

        Room::insert($rooms);
    }
}
