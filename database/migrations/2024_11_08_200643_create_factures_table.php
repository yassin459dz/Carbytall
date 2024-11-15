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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();//
            $table->foreignId('car_id')->constrained('cars')->cascadeOnDelete();//
            // $table->foreignId('matricule_id')->constrained('matricules')->cascadeOnDelete();
            //$table->unsignedInteger('facture_number')->unique();//
            $table->string('mat');
            $table->unsignedInteger('km');
            $table->string('product');
            $table->decimal('price', 10, 2);
            $table->integer('qte');
            $table->decimal('total', 10, 2);
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
