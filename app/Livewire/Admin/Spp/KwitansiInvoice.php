<?php

namespace App\Livewire\Admin\Spp;


use App\Models\Spp\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class KwitansiInvoice extends Component
{
    public function cetakKwitansi($id)
    {
        $pembayaran = Pembayaran::with(['santri', 'santri.kelas', 'santri.semester', 'santri.angkatan', 'pembayaranTipe', 'cicilans', 'pembayaranTimeline'])->findOrFail($id);

        $pdf = Pdf::loadView('livewire.admin.spp.kwitansi-invoice', [
            'pembayaran' => $pembayaran
        ]);

        return $pdf->download("Kwitansi Pembayaran Bulan {$pembayaran->pembayaranTimeline->nama_bulan} - {$pembayaran->santri->nama}.pdf");
    }
}
