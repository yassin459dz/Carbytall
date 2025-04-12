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
            // si vous voulez relier à une facture
            $table->foreignId('facture_id')->nullable()->constrained('factures')->onDelete('set null');
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
