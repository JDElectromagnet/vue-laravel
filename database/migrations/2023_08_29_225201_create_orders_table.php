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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('amount');
            $table->string('buyer', 255);
            $table->string('receipt_id', 20);
            $table->string('items', 255);
            $table->string('buyer_email', 50);
            $table->string('buyer_ip', 20)->nullable();
            $table->string('note');
            $table->string('city', 20);
            $table->string('phone', 20);
            $table->string('hash_key', 255)->nullable();
            $table->date('entry_at')->nullable();
            $table->string('entry_by', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
