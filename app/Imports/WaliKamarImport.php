<?php

namespace App\Imports;

use App\Models\WaliKamar;
use Maatwebsite\Excel\Concerns\ToModel;

class WaliKamarImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new WaliKamar([
            'nama' => $row[0],
            'alamat' => $row[1],
            'role' => $row[2],
            'foto' => $row[3], // Handle photo upload later
            'no_whatsapp' => $row[4],
        ]);
    }
}
