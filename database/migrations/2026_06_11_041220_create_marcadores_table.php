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
        Schema::create('marcadores', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100);
            $table->text('descricao')->nullable();

            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);

            $table->json('properties')->nullable(); // dados extras (ícone, cor, etc.)
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marcadores');
    }
};
