<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories =  [
            [
                'code' => 'TOOLK',
                'name' => 'Toolkit'
            ],
            [
                'code' => 'OPR',
                'name' => 'Operasional'
            ],
            [
                'code' => 'MNTN',
                'name' => 'Maintenance'
            ],
            [
                'code' => 'OB',
                'name' => 'Office Boy'
            ],
            [
                'code' => 'HK',
                'name' => 'House Keepeing'
            ],
            [
                'code' => 'ATK',
                'name' => 'Alat Tulis Kantor'
            ],
            [
                'code' => 'AIR',
                'name' => 'Air Mineral'
            ],
            [
                'code' => 'SARBAN',
                'name' => 'Sarung Bantal'
            ],
            [
                'code' => 'SPR',
                'name' => 'Sprei'
            ],
            [
                'code' => 'LPTP',
                'name' => 'Laptop'
            ],
            [
                'code' => 'DMPRK',
                'name' => 'Bangku Dampar Kecil'
            ],
            [
                'code' => 'DMPRB',
                'name' => 'Bangku Dampar Besar'
            ]
        ];
        Category::insert($categories);
    }
}
