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
            $table->enum('kewarganegaraan', ['wni', 'wna'])->default('wni');
            $table->bigInteger('nik');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->enum('jenis_kelamin', ['puteri', 'putera']);
            $table->string('jumlah_saudara_kandung');
            $table->string('anak_ke');
            $table->string('agama')->default('islam');
            $table->string('hobi');
            $table->enum('aktivitas_pendidikan', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('npsn');
            $table->string('no_kip')->nullable();
            $table->string('no_kk');
            $table->string('nama_kepala_keluarga');

            $table->enum('riwayat_penyakit', ['sehat', 'kurang_sehat']);
            $table->enum('status_kesantrian', ['aktif', 'nonaktif'])->default('aktif');
            $table->enum('status_santri', ['reguler', 'dhuafa', 'yatim_piatu']);

            $table->string('asal_sekolah')->default('Sekolah');
            $table->string('yang_membiayai_sekolah')->default('Ayah');

            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onUpdate('cascade')->onDelete('cascade')->default(1);
            $table->foreignId('kamar_id')->nullable()->constrained('kamars')->onUpdate('cascade')->onDelete('cascade')->default(1);
            $table->foreignId('semester_id')->nullable()->constrained('semesters')->onUpdate('cascade')->onDelete('cascade')->default(1);
            $table->foreignId('angkatan_id')->nullable()->constrained('angkatans')->onUpdate('cascade')->onDelete('cascade')->default(1);

            $table->timestamps();
        });

        Schema::create('orang_tua_santris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->nullable()->constrained('santris')->onDelete('cascade')->onUpdate('cascade');

            // Data Ayah
            $table->string('nama_ayah');
            $table->enum('status_ayah', ['hidup', 'meninggal']);
            $table->enum('kewarganegaraan_ayah', ['wni', 'wna'])->default('wni');
            $table->string('nik_ayah')->default("0081921827873");
            $table->string('tempat_lahir_ayah');
            $table->date('tanggal_lahir_ayah')->default(date(now()));
            $table->enum('pendidikan_terakhir_ayah', ['tidak sekolah', 'sd', 'smp', 'sma', 'slta', 'diploma', 'sarjana'])->default("sarjana");
            $table->string('pekerjaan_ayah');
            $table->string('penghasilan_ayah');
            $table->string('no_telp_ayah');

            // Data Ibu
            $table->string('nama_ibu');
            $table->enum('status_ibu', ['hidup', 'meninggal'])->default("hidup");
            $table->enum('kewarganegaraan_ibu', ['wni', 'wna'])->default('wni');
            $table->string('nik_ibu');
            $table->string('tempat_lahir_ibu');
            $table->string('tanggal_lahir_ibu');
            $table->enum('pendidikan_terakhir_ibu', ['tidak sekolah', 'sd', 'smp', 'sma', 'slta', 'diploma', 'sarjana'])->default("sarjana");
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
            $table->enum('status_orang_tua', ['kawin', 'cerai hidup', 'cerai mati'])->default("kawin");

            $table->timestamps();
        });

        // Tabel pengumuman
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi_pengumuman');
            $table->date('tanggal');
            $table->timestamps();
        });

        // Tabel kegiatan
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi_kegiatan');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->timestamps();
        });

        // Tabel Jadwal Piket
        Schema::create('jadwal_piket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santris')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas')->onUpdate('cascade')->onDelete('cascade');
            $table->string('keterangan');
            $table->enum('waktu', ['pagi', 'siang', 'sore', 'malam']);
            $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']);
            $table->enum('role_guru', ['diniyyah', 'umum'])->default('umum');
            $table->timestamps();
        });

        Schema::create('kategori_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('deskripsi');
            $table->enum('role_guru', ['diniyyah', 'umum'])->default('umum');
            $table->timestamps();
        });

        Schema::create('jadwal_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kategori_pelajaran_id')->constrained('kategori_pelajaran')->onUpdate('cascade')->onDelete('cascade');
            $table->string('mata_pelajaran');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']);
            $table->enum('role_guru', ['diniyyah', 'umum'])->default('umum');
            $table->timestamps();   
        });
        
        Schema::create('tahun_ajarans', function (Blueprint $table) {
            $table->string('nama_tahun')->primary();
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
        Schema::dropIfExists('kegiatan');
        Schema::dropIfExists('pengumuman');
        Schema::dropIfExists('jadwal_piket');
        Schema::dropIfExists('jadwal_pelajaran');
        Schema::dropIfExists('kategori_pelajaran');
        Schema::dropIfExists('tahun_ajaran');
    }
};
