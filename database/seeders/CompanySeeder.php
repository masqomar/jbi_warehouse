<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies =  [
            [
                'code' => 'JBI',
                'name' => 'Jago Bahasa Inspira',
                'phone' => '99',
                'address' => 'pare',
                'status' => 1
            ],
            [
                'code' => 'LCP',
                'name' => 'Language Center Pusat',
                'phone' => '99',
                'address' => 'pare',
                'status' => 1
            ],
            [
                'code' => 'JB',
                'name' => 'Jago Bahasa',
                'phone' => '99',
                'address' => 'pare',
                'status' => 1
            ],
            [
                'code' => 'ANJ',
                'name' => 'An Najah',
                'phone' => '99',
                'address' => 'pare',
                'status' => 1
            ],
            [
                'code' => 'LCB',
                'name' => 'Language Center Bogor',
                'phone' => '99',
                'address' => 'Bogor',
                'status' => 1
            ],
            [
                'code' => 'LCJ',
                'name' => 'Language Center Jogja',
                'phone' => '99',
                'address' => 'Jogja',
                'status' => 1
            ],
            [
                'code' => 'LCBA',
                'name' => 'Language Center Bandung',
                'phone' => '99',
                'address' => 'Bandung',
                'status' => 1
            ],
            [
                'code' => 'LCBE',
                'name' => 'Language Center Bekasi',
                'phone' => '99',
                'address' => 'Bekasi',
                'status' => 1
            ]
        ];

        Company::insert($companies);
    }
}
