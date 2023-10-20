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
        Schema::create('menues', function (Blueprint $table) {
            $table->id();
            $table->string('serial')->nullable();
            $table->string('shop_email')->nullable();
            $table->string('name')->nullable();
            $table->string('img')->nullable();
            $table->longText('description')->nullable();
            $table->double('start_price')->default(0);
            $table->string('discount')->default('no');
            $table->double('discount_percent')->default(0);
            $table->string('prev_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menues');
    }
};
