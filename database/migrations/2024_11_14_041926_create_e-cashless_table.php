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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_number')->unique(); 
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_number')->unique(); 
            $table->string('name');
            $table->string('foto')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stok');
            $table->foreignId('seller_id')->constrained('users');
            $table->foreignId('category_id')->constrained('categories');
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number'); 
            $table->string('user');
            // $table->decimal('tax', 10, 2)->default(0);
            // $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Tabel pivot untuk relasi many-to-many antara transactions dan products
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_number')->unique(); // Nomor pembayaran unique
            $table->foreignId('transaction_items_id')->constrained('transaction_items')->onDelete('cascade');
            $table->string('payment_method');
            $table->string('bukti_pembayaran');
            $table->enum('payment_status', ['pending', 'processing', 'success', 'failed']);
            $table->datetime('payment_date');
            $table->decimal('amount', 10, 2);
            $table->decimal('returns', 10, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('laundry_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('estimate');
            $table->string('unit');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        Schema::create('laundry_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // Nomor pesanan laundry unique
            $table->foreignId('santri_id')->constrained('santris')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('laundry_service_id')->constrained('laundry_services')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity');
            $table->decimal('subtotal', 10, 2);
            $table->enum('status', ['menunggu', 'dicuci', 'gagal', 'disetrika', 'siap diambil', 'diterima']);
            $table->string('end_date');
            $table->timestamps();
        });

        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained('payments');
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundry_orders');
        Schema::dropIfExists('laundry_services');
        Schema::dropIfExists('laundries');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('transaction_items');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('products');
        Schema::dropIfExists('payment_details');
    }
};
