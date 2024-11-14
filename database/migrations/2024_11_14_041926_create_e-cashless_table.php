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
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->foreignId('seller_id')->constrained('users');
            $table->foreignId('category_id')->constrained('categories');
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'paid', 'delivered']);
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->datetime('payment_date');
            $table->decimal('amount', 10, 2);
            $table->decimal('kembalian', 10, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('laundries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->string('address');
            $table->string('phone_number');
            $table->timestamps();
        });

        Schema::create('laundry_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laundry_id')->constrained('laundries');
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        Schema::create('laundry_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('laundry_service_id')->constrained('laundry_services');
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'picked_up', 'delivered']);
            $table->timestamps();
        });

        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('laundries');
        Schema::dropIfExists('laundry_services');
        Schema::dropIfExists('laundry_orders');
        Schema::dropIfExists('payment_details');
    }
};
