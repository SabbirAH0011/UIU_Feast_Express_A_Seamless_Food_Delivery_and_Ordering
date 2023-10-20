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
        Schema::create('main_orders', function (Blueprint $table) {
            $table->id();
            $table->string('oder_id')->nullable();
            $table->string('client')->nullable();
            $table->string('address')->nullable();
            $table->longText('products')->nullable();
            $table->double('delivery_charge')->default(0);
            $table->double('total_price')->default(0);
            $table->string('delivery_man')->nullable();
            $table->string('status')->default('Unpicked');
            $table->string('payment_method')->nullable();
            $table->longText('token')->nullable();
            $table->string('payment_status')->default('Unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_orders');
    }
};
