<?php

namespace App\Imports;

use App\Models\Guest;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuestImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        return new Guest([
            'name' => $row['name'],
            'surname' => $row['surname'],
            'email' => $row['email'],
            'jmbag' => $row['jmbag'],
            'phone' => $row['phone'],
            'tag' => $row['tag'],
        ]);
    }
}
