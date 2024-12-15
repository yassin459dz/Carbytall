<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFacturesTable extends Migration
{
    public function up()
    {
        Schema::table('factures', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2);
            $table->decimal('extra_charge', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->json('order_items')->nullable(); // Store order items
        });
    }

    public function down()
    {
        Schema::dropIfExists('factures');
    }
}

