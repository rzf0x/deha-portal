<?php
namespace App\Livewire\Admin\Spp;

use App\Models\Santri;
use App\Models\Spp\Pembayaran; // Pastikan model ini diimpor
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class DetailLaporanSppSantri extends Component
{
    use WithPagination;
    #[Title('Halaman Detail Spp Santri')]

    protected $paginationTheme = 'bootstrap';
    
    public $santriId;
    public $santri;
    public $filter = [
        'tahun' => '',
        'status' => ''
    ];
    
    public function mount($id)
    {
        $this->santriId = $id;
        $this->santri = Santri::with(['kelas', 'kamar','pembayaran'])->findOrFail($id);
        $this->filter['tahun'] = date('Y');
    }
    
    public function getPaymentSummaryProperty()
    {
        return $this->santri->pembayaran()
            ->when($this->filter['tahun'], function($query) {
                return $query->whereYear('created_at', $this->filter['tahun']);
            })
            ->when($this->filter['status'], function($query) {
                return $query->where('status', $this->filter['status']);
            })->get();
    }
    
    public function render()
    {
        $pembayaran = $this->santri->pembayaran()
            ->with('pembayaranTimeline') // Menggunakan relasi yang benar
            ->when($this->filter['tahun'], function($query) {
                return $query->whereYear('created_at', $this->filter['tahun']);
            })
            ->when($this->filter['status'], function($query) {
                return $query->where('status', $this->filter['status']);
            })
            ->latest()
            ->paginate(10);
        
        // Menggunakan model Pembayaran dengan namespace yang benar
        $tahunList = Pembayaran::selectRaw('YEAR(created_at) as tahun')
            ->where('santri_id', $this->santriId)
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');
        
        return view('livewire.admin.spp.detail-laporan-spp-santri', [
            'pembayaran' => $pembayaran,
            'tahunList' => $tahunList,
            'total_pembayaran' => $pembayaran->count(),
            'total_lunas' => $pembayaran->where('status', 'lunas')->count(),
            'total_pending' => $pembayaran->where('status', 'pending')->count(),
            'total_nominal' => $pembayaran->sum('nominal'),
        ]);
    }
}
