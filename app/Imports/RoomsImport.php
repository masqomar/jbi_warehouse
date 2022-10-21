<?php

namespace App\Imports;

use App\Models\Room;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

// class RoomsImport implements ToModel, WithHeadingRow
// {
//     /**
//      * @param array $row
//      *
//      * @return \Illuminate\Database\Eloquent\Model|null
//      */
//     public function model(array $row)
//     {
//         return new Room([
//             'name'          => $row['name'],
//             'status'        => $row['status'],
//             'building_id'   => $row['building_id'],
//             'company_id'    => $row['company_id']
//         ]);
//     }
// }

class RoomsImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            0 => new Room(),
        ];
    }
}
