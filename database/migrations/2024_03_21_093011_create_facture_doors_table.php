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
        Schema::create('facture_doors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('door_id')->references('id')->on('doors')->nullable();
            $table->string('id_facture');
            $table->date('day');
            $table->integer('qty');
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
        Schema::dropIfExists('facture_doors');
    }
};
