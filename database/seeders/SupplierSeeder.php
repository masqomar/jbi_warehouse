<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            [
                'name' => 'Paijo',
                'phone' => '12456',
                'address' => 'Pare'
            ],
            [
                'name' => 'Paimen',
                'phone' => '12456',
                'address' => 'Pare'
            ],
            [
                'name' => 'Siti',
                'phone' => '12456',
                'address' => 'Pare'
            ],
        ];

        Supplier::insert($suppliers);
    }
}
