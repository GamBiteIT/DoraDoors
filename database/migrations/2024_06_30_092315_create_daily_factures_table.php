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
        Schema::create('daily_factures', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->float('price_in')->nullable();
            $table->float('price_out')->nullable();
            $table->string('description')->nullable();
            $table->float('price_net')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_factures');
    }
};
