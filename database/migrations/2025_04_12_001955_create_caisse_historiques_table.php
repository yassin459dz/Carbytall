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
        Schema::create('caisse_historiques', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['ENTRÉE', 'SORTIE'])->index();
            $table->decimal('montant', 15, 2);
            $table->string('description')->nullable();
            $table->decimal('start_value', 15, 2)->nullable(); // ✅ New column
            $table->decimal('end_value', 15, 2)->nullable(); // ✅ New column

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caisse_historiques');
    }
};
