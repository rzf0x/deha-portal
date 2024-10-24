<?php

namespace App\Livewire\Admin;

use App\Exports\SantriExport;
use App\Livewire\Forms\SantriForm;
use App\Livewire\Forms\WaliSantriForm;
use App\Models\admin\Semester;
use App\Models\admin\Angkatan;
use App\Models\Santri;
use App\Models\Kamar;
use App\Models\Kelas;
use App\Models\OrangTuaSantri;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ListSantri extends Component
{
    use WithPagination;
    use WithFileUploads;
    #[Title('Halaman List Santri')]
    protected $paginationTheme = 'bootstrap';

    public SantriForm $santriForm;
    public WaliSantriForm $waliSantriForm;

    public $npsn = '70005521';

    // data
    public $kelas, $kamar, $semester, $angkatan, $santri_id, $santriEditId, $formPage = 1;

    #[Url(except: '', as: 'q-santri')]
    public $search;

    public function mount()
    {
        // get url params edit has id wali santri
        if(request()->has('wali')) {
            // parse argument of edit function parameter
            $this->edit(request()->wali);
            // trigger livewire javascript dispatch
            $this->dispatch('showModal');
        }

        $this->kelas = Kelas::with('jenjang')->get();
        $this->kamar = Kamar::with('waliKamar')->get();
        $this->semester = Semester::all();
        $this->angkatan = Angkatan::all();
    }

    public function prevForm()
    {
        $this->formPage--;
    }
    public function nextForm()
    {
        $this->formPage++;
    }
    public function create()
    {
        $this->santriForm->reset();
        $this->waliSantriForm->reset();
        $this->santriEditId = null;
    }

    public function createStore()
    {
        $this->santriForm->validate();
        $this->waliSantriForm->validate();

        if ($this->santriForm->foto) {
            $imgFile = $this->santriForm->foto;
            $imgUrl = $imgFile->store('images/santri', 'public');
            $this->santriForm->foto = $imgUrl;
        }
        $santri = Santri::create($this->santriForm->all());

        $waliSantriData = $this->waliSantriForm->all();
        $waliSantriData['santri_id'] = $santri->id;
        OrangTuaSantri::create($waliSantriData);
        return to_route('admin.master-santri.santri')->with(['message' => "Success created " . $this->santriForm->nama . " !"]);
    }

    public function edit($santriId)
    {
        $this->santriEditId = $santriId;

        // Data Santri
        $santriData = Santri::findOrFail($santriId);

        // Data Wali dan Data Alamat
        $waliData = OrangTuaSantri::where('santri_id', $santriId)->first();
        $this->santriForm->foto = $santriData->foto;
        $this->santriForm->nama = $santriData->nama;
        $this->santriForm->nisn = $santriData->nisn;
        $this->santriForm->nism = $santriData->nism;
        $this->santriForm->kewarganegaraan = $santriData->kewarganegaraan;
        $this->santriForm->nik = $santriData->nik;
        $this->santriForm->tempat_lahir = $santriData->tempat_lahir;
        $this->santriForm->tanggal_lahir = $santriData->tanggal_lahir;
        $this->santriForm->jenis_kelamin = $santriData->jenis_kelamin;
        $this->santriForm->jumlah_saudara_kandung = $santriData->jumlah_saudara_kandung;
        $this->santriForm->anak_ke = $santriData->anak_ke;
        $this->santriForm->agama = $santriData->agama;
        $this->santriForm->hobi = $santriData->hobi;
        $this->santriForm->aktivitas_pendidikan = $santriData->aktivitas_pendidikan;
        $this->santriForm->npsn = $santriData->npsn;
        $this->santriForm->no_kip = $santriData->no_kip;
        $this->santriForm->no_kk = $santriData->no_kk;
        $this->santriForm->nama_kepala_keluarga = $santriData->nama_kepala_keluarga;
        $this->santriForm->riwayat_penyakit = $santriData->riwayat_penyakit;
        $this->santriForm->status_kesantrian = $santriData->status_kesantrian;
        $this->santriForm->status_santri = $santriData->status_santri;
        $this->santriForm->asal_sekolah = $santriData->asal_sekolah;
        $this->santriForm->yang_membiayai_sekolah = $santriData->yang_membiayai_sekolah;

        $this->santriForm->kelas_id = $santriData->kelas_id;
        $this->santriForm->kamar_id = $santriData->kamar_id;
        $this->santriForm->semester_id = $santriData->semester_id;
        $this->santriForm->angkatan_id = $santriData->angkatan_id;

        // Data Ayah
        $this->waliSantriForm->nama_ayah = $waliData->nama_ayah;
        $this->waliSantriForm->status_ayah = $waliData->status_ayah;
        $this->waliSantriForm->kewarganegaraan_ayah = $waliData->kewarganegaraan_ayah;
        $this->waliSantriForm->nik_ayah = $waliData->nik_ayah;
        $this->waliSantriForm->tempat_lahir_ayah = $waliData->tempat_lahir_ayah;
        $this->waliSantriForm->tanggal_lahir_ayah = $waliData->tanggal_lahir_ayah;
        $this->waliSantriForm->pendidikan_terakhir_ayah = $waliData->pendidikan_terakhir_ayah;
        $this->waliSantriForm->pekerjaan_ayah = $waliData->pekerjaan_ayah;
        $this->waliSantriForm->penghasilan_ayah = $waliData->penghasilan_ayah;
        $this->waliSantriForm->no_telp_ayah = $waliData->no_telp_ayah;

        // Data Ibu
        $this->waliSantriForm->santri_id = $waliData->santri_id;
        $this->waliSantriForm->nama_ibu = $waliData->nama_ibu;
        $this->waliSantriForm->status_ibu = $waliData->status_ibu;
        $this->waliSantriForm->kewarganegaraan_ibu = $waliData->kewarganegaraan_ibu;
        $this->waliSantriForm->nik_ibu = $waliData->nik_ibu;
        $this->waliSantriForm->tempat_lahir_ibu = $waliData->tempat_lahir_ibu;
        $this->waliSantriForm->tanggal_lahir_ibu = $waliData->tanggal_lahir_ibu;
        $this->waliSantriForm->pendidikan_terakhir_ibu = $waliData->pendidikan_terakhir_ibu;
        $this->waliSantriForm->pekerjaan_ibu = $waliData->pekerjaan_ibu;
        $this->waliSantriForm->penghasilan_ibu = $waliData->penghasilan_ibu;
        $this->waliSantriForm->no_telp_ibu = $waliData->no_telp_ibu;

        // Data Alamat
        $this->waliSantriForm->status_kepemilikan_rumah = $waliData->status_kepemilikan_rumah;
        $this->waliSantriForm->provinsi = $waliData->provinsi;
        $this->waliSantriForm->kabupaten = $waliData->kabupaten;
        $this->waliSantriForm->kecamatan = $waliData->kecamatan;
        $this->waliSantriForm->kelurahan = $waliData->kelurahan;
        $this->waliSantriForm->rt = $waliData->rt;
        $this->waliSantriForm->rw = $waliData->rw;
        $this->waliSantriForm->alamat = $waliData->alamat;
        $this->waliSantriForm->kode_pos = $waliData->kode_pos;
        $this->waliSantriForm->status_orang_tua = $waliData->status_orang_tua;
    }

    public function editStore()
    {
        if (is_object($this->santriForm->foto) && method_exists($this->santriForm->foto, 'store')) {
            $imgFile = $this->santriForm->foto;
            $imgUrl = $imgFile->store('images/santri', 'public');
            $this->santriForm->foto = $imgUrl;
        } else {
            $oldImg = Santri::where('id', $this->santriEditId)->value('foto');
            $this->santriForm->foto = $oldImg;
        }

        Santri::where('id', $this->santriEditId)->update($this->santriForm->all());
        OrangTuaSantri::where('santri_id', $this->santriEditId)->update($this->waliSantriForm->all());

        return to_route('admin.master-santri.santri')->with(['message' => "Success updated " . Santri::where('id', $this->santriEditId)->value('nama') . " !"]);
    }


    public function delete($santriId)
    {
        Santri::findOrFail($santriId)->delete();
        return session()->flash('message', "Data has been deleted!");
    }

    public function export()
    {
        return Excel::download(new SantriExport, 'santri.xlsx');
    }

    #[Computed]
    public function getData()
    {
        if ($this->search) {
            return Santri::with(['kelas', 'kamar'])
                ->where(function ($query) {
                    $query->whereRaw('nama LIKE ? OR CASE 
                        WHEN jenis_kelamin = "putera" THEN "laki-laki"
                        WHEN jenis_kelamin = "puteri" THEN "perempuan"
                        END LIKE ?', [
                        "%{$this->search}%",
                        "%{$this->search}%"
                    ]);
                })
                ->orWhereHas('kelas', function ($query) {
                    $query->where('nama', 'LIKE', "%{$this->search}%");
                })
                ->orWhereHas('kelas.jenjang', function ($query) {
                    $query->where('nama', 'LIKE', "%{$this->search}%");
                })
                ->orWhereHas('kamar', function ($query) {
                    $query->where('nama', 'LIKE', "%{$this->search}%");
                })
                ->paginate(5);
        }

        return Santri::with(['kelas', 'kamar'])->paginate(5);
    }

    // private function resetField()
    // {
    //     $this->nama = '';
    //     $this->nisn = '';
    //     $this->nism = '';
    //     $this->kewarganegaraan = '';
    //     $this->nik = '';
    //     $this->tempat_lahir = '';
    //     $this->tanggal_lahir = '';
    //     $this->jenis_kelamin = '';
    //     $this->jumlah_saudara_kandung = '';
    //     $this->anak_ke = '';
    //     $this->agama = '';
    //     $this->hobi = '';
    //     $this->aktivitas_pendidikan = '';
    //     $this->npsn = '';
    //     $this->no_kip = '';
    //     $this->no_kk = '';
    //     $this->nama_kepala_keluarga = '';
    // }

    public function render()
    {
        return view('livewire.admin.list-santri');
    }
}
