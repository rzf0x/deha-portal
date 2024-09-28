<?php

namespace App\Exports\admin;

use App\Models\WaliKamar;
use Maatwebsite\Excel\Concerns\FromCollection;

class WalikamarExport implements FromCollection
{
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Alamat',
            'Foto', // You might want to handle photo export differently
            'No WhatsApp',
        ];
    }

    public function collection()
    {
        return WaliKamar::all(['id', 'nama', 'alamat', 'foto', 'no_whatsapp']);
    }
}
