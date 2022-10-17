<?php

namespace Database\Seeders;

use App\Models\Devision;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DevisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $devisions = [
            [
                'name' => 'Operasional',
                'company_id' => 1,
            ],
            [
                'name' => 'Marketing',
                'company_id' => 1,
            ],
            [
                'name' => 'Program',
                'company_id' => 1,
            ],
            [
                'name' => 'Operasional',
                'company_id' => 2,
            ],
            [
                'name' => 'Marketing',
                'company_id' => 2,
            ],
            [
                'name' => 'Program',
                'company_id' => 2,
            ],
            [
                'name' => 'Operasional',
                'company_id' => 3,
            ],
            [
                'name' => 'Marketing',
                'company_id' => 3,
            ],
            [
                'name' => 'Program',
                'company_id' => 3,
            ],
            [
                'name' => 'Operasional',
                'company_id' => 4,
            ],
            [
                'name' => 'Marketing',
                'company_id' => 4,
            ],
            [
                'name' => 'Program',
                'company_id' => 4,
            ],
            [
                'name' => 'Operasional',
                'company_id' => 5,
            ],
            [
                'name' => 'Marketing',
                'company_id' => 5,
            ],
            [
                'name' => 'Program',
                'company_id' => 5,
            ],

        ];

        Devision::insert($devisions);
    }
}
