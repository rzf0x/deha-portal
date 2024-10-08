<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jenjangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('roles_id')->constrained('roles')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('wali_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('foto');
            $table->string('no_whatsapp');
            $table->timestamps();
        });

        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('wali_kelas')->constrained('wali_kelas')->onDelete('cascade');
            $table->foreignId('jenjang_id')->constrained('jenjangs')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('wali_kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->enum('role', ['putera', 'puteri'])->default('putera');
            $table->string('foto')->nullable();
            $table->string('no_whatsapp');
            $table->timestamps();
        });

        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('kamar_tipe', ['putera', 'puteri']);
            $table->foreignId('wali_kamar')->constrained('wali_kamars')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('angkatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->timestamps();
        });

        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->timestamps();
        });

        Schema::create('santris', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nama');
            $table->string('nisn');
            $table->string('nism');
            $table->string('kewarganegaraan')->default('Indonesia');
            $table->bigInteger('nik');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->enum('jenis_kelamin', ['perempuan', 'laki-laki']);
            $table->string('jumlah_saudara_kandung');
            $table->string('anak_ke');
            $table->string('agama')->default('islam');
            $table->string('hobi');
            $table->string('aktivitas_pendidikan');
            $table->string('npsn');
            $table->string('no_kip')->nullable();
            $table->string('no_kk');
            $table->string('nama_kepala_keluarga');

            // $table->string('nama_sekolah');
            // $table->string('yang_membiyayai_sekolah');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade');

            $table->enum('riwayat_penyakit', ['santri sehat', 'kurang sehat'])->default('santri sehat');
            $table->enum('status_kesantrian', ['aktif', 'nonaktif']);
            $table->enum('status_santri', ['reguler', 'dhuafa', 'yatim-piatu']);
            // $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade');
            // $table->foreignId('angkatan_id')->constrained('angkatans')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('orang_tua_santris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santris')->onDelete('cascade');

            // Data Ayah
            $table->string('nama_ayah');
            $table->enum('status_ayah', ['hidup', 'meniggal']);
            $table->enum('kewarganegaraan_ayah', ['WNI', 'WNA'])->default('WNI');
            $table->string('nik_ayah');
            $table->string('tempat_lahir_ayah');
            $table->string('tanggal_lahir_ayah');
            $table->string('pendidikan_terakhir_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('penghasilan_ayah');
            $table->string('no_telp_ayah');

            // Data Ibu
            $table->string('nama_ibu');
            $table->enum('status_ibu', ['hidup', 'meniggal']);
            $table->enum('kewarganegaraan_ibu', ['WNI', 'WNA'])->default('WNI');
            $table->string('nik_ibu');
            $table->string('tempat_lahir_ibu');
            $table->string('tanggal_lahir_ibu');
            $table->string('pendidikan_terakhir_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('penghasilan_ibu');
            $table->string('no_telp_ibu');

            // Alamat Orang Tua
            $table->string('status_kepemilikan_rumah');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('rt');
            $table->string('rw');
            $table->string('alamat');
            $table->string('kode_pos');

            $table->enum('status_orang_tua', ['yatim', 'piatu', 'yatim-piatu']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenjangs');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('wali_kelas');
        Schema::dropIfExists('kelas');
        Schema::dropIfExists('wali_kamars');
        Schema::dropIfExists('kamars');
        Schema::dropIfExists('angkatans');
        Schema::dropIfExists('semesters');
        Schema::dropIfExists('santris');
        Schema::dropIfExists('orang_tua_santris');

    }
};
