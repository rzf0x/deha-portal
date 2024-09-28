<?php

namespace App\Imports\Admin;

use App\Models\Kamar;
use Maatwebsite\Excel\Concerns\ToModel;

class KamarImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Kamar([
            'nama' => $row[0],
            'namar_tipe' => $row[1],
            'wali_kamar' => $row[2]
        ]);
    }
}
