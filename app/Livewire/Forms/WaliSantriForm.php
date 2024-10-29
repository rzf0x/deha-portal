<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class WaliSantriForm extends Form
{
    // DATA AYAH
    #[Validate('required')]
    public $nama_ayah;
    #[Validate('required')]
    public $status_ayah;
    #[Validate('required')]
    public $kewarganegaraan_ayah;
    #[Validate('required')]
    public $nik_ayah;
    #[Validate('required')]
    public $tempat_lahir_ayah;
    #[Validate('required')]
    public $tanggal_lahir_ayah;
    #[Validate('required|in:tidak sekolah,sd,smp,sma,slta,diploma,sarjana')]
    public $pendidikan_terakhir_ayah;
    #[Validate('required')]
    public $pekerjaan_ayah;
    #[Validate('required')]
    public $penghasilan_ayah;
    #[Validate('required')]
    public $no_telp_ayah;

    // DATA IBU
    #[Validate('required')]
    public $nama_ibu;
    #[Validate('required')]
    public $status_ibu;
    #[Validate('required')]
    public $kewarganegaraan_ibu;
    #[Validate('required')]
    public $nik_ibu;
    #[Validate('required')]
    public $tempat_lahir_ibu;
    #[Validate('required')]
    public $tanggal_lahir_ibu;
    #[Validate('required|in:tidak sekolah,sd,smp,sma,slta,diploma,sarjana')]
    public $pendidikan_terakhir_ibu;
    #[Validate('required')]
    public $pekerjaan_ibu;
    #[Validate('required')]
    public $penghasilan_ibu;
    #[Validate('required')]
    public $no_telp_ibu;

    // DATA LAINNYA
    #[Validate('required')]
    public $status_kepemilikan_rumah;
    #[Validate('required')]
    public $provinsi;
    #[Validate('required')]
    public $kabupaten;
    #[Validate('required')]
    public $kecamatan;
    #[Validate('required')]
    public $kelurahan;
    #[Validate('required')]
    public $rt;
    #[Validate('required')]
    public $rw;
    #[Validate('required')]
    public $alamat;
    #[Validate('required')]
    public $kode_pos;
    #[Validate('required')]
    public $status_orang_tua;

    #[Validate('nullable')]
    public $santri_id;
}

