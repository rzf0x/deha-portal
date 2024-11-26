<?php

namespace App\Livewire\Admin\Spp;

use App\Models\Spp\Cicilan;
use App\Models\Spp\DetailItemPembayaran;
use App\Models\Spp\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class KwitansiInvoice extends Component
{
    public function cetakKwitansiPembayaran($id)
    {
        $pembayaran = Pembayaran::with(['santri', 'santri.kelas', 'santri.semester', 'santri.angkatan', 'pembayaranTipe', 'cicilans', 'pembayaranTimeline'])->findOrFail($id);
        

        $pdf = Pdf::loadView('livewire.admin.spp.kwitansi-invoice', [
            'pembayaran' => $pembayaran,
            'detailPembayaran' => DetailItemPembayaran::where('jenjang_id', $pembayaran->santri->kelas->jenjang->id)->get(),
        ]);

        return $pdf->download("Kwitansi Pembayaran Bulan {$pembayaran->pembayaranTimeline->nama_bulan} - {$pembayaran->santri->nama}.pdf");
    }

    public function cetakKwitansiCicilan($id)
    {
        $cicilan = Cicilan::findOrFail($id);
        
        $pembayaran = Pembayaran::with(['santri', 'santri.kelas', 'santri.semester', 'santri.angkatan', 'pembayaranTipe', 'cicilans', 'pembayaranTimeline'])->findOrFail($cicilan->pembayaran_id);
        
        $pdf = Pdf::loadView('livewire.admin.spp.kwitansi-invoice', [
            'pembayaran' => $pembayaran,
            'cicilan' => $cicilan,
            'detailPembayaran' => DetailItemPembayaran::where('jenjang_id', $pembayaran->santri->kelas->jenjang->id)->get(),
        ]);

        return $pdf->download("Kwitansi Pembayaran Bulan {$pembayaran->pembayaranTimeline->nama_bulan} - {$pembayaran->santri->nama}.pdf");
    }
}
