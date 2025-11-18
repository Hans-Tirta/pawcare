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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rescue_case_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('species', ['dog', 'cat', 'bird', 'rabbit', 'other'])->default('other');
            $table->string('age')->nullable(); // e.g., "2 bulan", "1 tahun"
            $table->enum('gender', ['male', 'female', 'unknown'])->default('unknown');
            $table->text('condition')->nullable(); // kondisi kesehatan
            $table->enum('status', ['treatment', 'recovered', 'adopted', 'deceased'])->default('treatment');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
