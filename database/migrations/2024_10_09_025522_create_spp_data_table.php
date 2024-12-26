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
        Schema::create('pembayaran_timeline', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bulan', 50);
            $table->timestamps();
        });

        Schema::create('pembayaran_tipe', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('pembayaran_detail', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nominal');

            $table->bigInteger('jenjang_id')->unsigned()->comment('relation with jenjang');
            $table->foreign('jenjang_id')->references('id')->on('jenjangs')->onDelete('cascade');

            $table->bigInteger('pembayaran_tipe_id')->unsigned()->comment('relation with pembayaran_tipe');
            $table->foreign('pembayaran_tipe_id')->references('id')->on('pembayaran_tipe')->onDelete('cascade');

            $table->string('tahun_ajaran_id')->comment('relation with tahun_ajarans')->default(date('Y'));
            $table->foreign('tahun_ajaran_id')->references('nama_tahun')->on('tahun_ajarans')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['belum bayar', 'lunas', 'cicilan'])->default('belum bayar');
            $table->string('nominal')->nullable();
            $table->enum('metode_pembayaran', ['transfer', 'cash'])->default('cash');
            $table->string('bukti_pembayaran')->nullable();

            // Relation with pembayaran_tipe
            $table->bigInteger('pembayaran_tipe_id')->unsigned()->comment('relation with pembayaran_tipe');
            $table->foreign('pembayaran_tipe_id')->references('id')->on('pembayaran_tipe')->onDelete('cascade');

            // Relation with santri
            $table->bigInteger('santri_id')->unsigned()->comment('relation with santri');
            $table->foreign('santri_id')->references('id')->on('santris')->onDelete('cascade');

            // Relation with pembayaran_timeline
            $table->bigInteger('pembayaran_timeline_id')->unsigned()->comment('relation with pembayaran_timeline');
            $table->foreign('pembayaran_timeline_id')->references('id')->on('pembayaran_timeline')->onDelete('cascade');

            // Relation with semester
            $table->bigInteger('semester_id')->unsigned()->comment('relation with semester')->default(1);
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');

            // Relation with angkatan
            $table->bigInteger('angkatan_id')->unsigned()->comment('relation with angkatan')->default(1);
            $table->foreign('angkatan_id')->references('id')->on('angkatans')->onDelete('cascade');


            $table->string('tahun_ajaran_id')->comment('relation with tahun_ajarans')->default(date('Y'));
            $table->foreign('tahun_ajaran_id')->references('nama_tahun')->on('tahun_ajarans')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('pembayaran_cicilan', function (Blueprint $table) {
            $table->id();
            $table->string('nominal');
            $table->string('keterangan');
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');
            // Relation with pembayaran
            $table->bigInteger('pembayaran_id')->unsigned()->comment('relation with pembayaran');
            $table->foreign('pembayaran_id')->references('id')->on('pembayaran')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_cicilan');
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('pembayaran_tipe');
        Schema::dropIfExists('pembayaran_detail');
        Schema::dropIfExists('pembayaran_timeline');
    }
};
