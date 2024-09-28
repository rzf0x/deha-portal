<?php

namespace App\Imports\Admin;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\ToModel;

class SantriImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
{
    return new Santri([
        'foto'                  => $row[0],  // Assuming photo is in first column
        'nama'                  => $row[1],
        'nisn'                  => $row[2],
        'nism'                  => $row[3],
        'kewarganegaraan'       => $row[4] ?? 'Indonesia',  // Default to Indonesia if not provided
        'nik'                   => $row[5],
        'tempat_lahir'          => $row[6],
        'tanggal_lahir'         => $row[7],
        'jenis_kelamin'         => $row[8],
        'jumlah_saudara_kandung'=> $row[9],
        'anak_ke'               => $row[10],
        'agama'                 => $row[11] ?? 'islam',  // Default to 'islam' if not provided
        'hobi'                  => $row[12],
        'aktivitas_pendidikan'  => $row[13],
        'npsn'                  => $row[14],
        'no_kip'                => $row[15] ?? null,
        'no_kk'                 => $row[16],
        'nama_kepala_keluarga'  => $row[17],
        'kelas_id'              => $row[18],
        'kamar_id'              => $row[19],
        // 'kelas_id'              => $this->getKelasId($row[18]),  // Assuming class name in the CSV and a method to get ID
        // 'kamar_id'              => $this->getKamarId($row[19]),  // Assuming room name in the CSV and a method to get ID
        'riwayat_penyakit'      => $row[20] ?? 'santri sehat',   // Default to 'santri sehat'
        'status_kesantrian'     => $row[21],
        'status_santri'         => $row[22],
    ]);
}

// Helper methods to get IDs from class/room names
// public function getKelasId($kelasName)
// {
//     return Kelas::where('name', $kelasName)->first()->id;
// }

// public function getKamarId($kamarName)
// {
//     return Kamar::where('name', $kamarName)->first()->id;
// }

}
