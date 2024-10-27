<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class SantriForm extends Form
{
    #[Validate('required')]
    public $nama;
    #[Validate('required')]
    public $nisn;
    #[Validate('required')]
    public $nism;
    #[Validate('required')]
    public $kewarganegaraan;
    #[Validate('required')]
    public $nik;
    #[Validate('required')]
    public $tempat_lahir;
    #[Validate('required')]
    public $tanggal_lahir;
    #[Validate('required')]
    public $jenis_kelamin;
    #[Validate('required')]
    public $jumlah_saudara_kandung;
    #[Validate('required')]
    public $anak_ke;
    #[Validate('required')]
    public $agama;
    #[Validate('required')]
    public $hobi;
    #[Validate('required')]
    public $npsn;
    #[Validate('required')]
    public $aktivitas_pendidikan;
    #[Validate('nullable')]
    public $no_kip;
    #[Validate('required')]
    public $no_kk;
    #[Validate('required')]
    public $nama_kepala_keluarga;
    #[Validate('required')]
    public $riwayat_penyakit;
    #[Validate('required|in:aktif,nonaktif')]
    public $status_kesantrian;
    #[Validate('required')]
    public $status_santri;
    #[Validate('required')]
    public $asal_sekolah;
    #[Validate('required')]
    public $yang_membiayai_sekolah;

    #[Validate('nullable')]
    public $kelas_id;
    #[Validate('nullable')]
    public $kamar_id;
    #[Validate('nullable')]
    public $semester_id;
    #[Validate('nullable')]
    public $angkatan_id;
}
