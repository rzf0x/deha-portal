<?php

namespace App\Exports\Admin;

use App\Models\Kamar;
use Maatwebsite\Excel\Concerns\FromCollection;

class KamarExport implements FromCollection
{
    public function headings(): array
    {
        return [
            'no',
            'nama_kamar',
            'wali_kamar',
            'kamar_tipe',
        ];
    }

    public function collection()
    {
        return Kamar::with('waliKamar')->get()->map(function($kamar, $index) {
            return [
                'no' => $index + 1,
                'nama_kamar' => $kamar->nama,
                'nama_wali_kamar' => $kamar->waliKamar->nama, // Access the related waliKamar's name
                'kamar_tipe' => $kamar->kamar_tipe,
            ];
        });
    }
}
