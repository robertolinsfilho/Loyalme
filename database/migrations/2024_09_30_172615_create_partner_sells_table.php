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
        Schema::create('partner_sells', function (Blueprint $table) {
            $table->id('external_id');
            $table->decimal('amount', total: 8, places: 2)->nullable();
            $table->decimal('comission_amount', total: 8, places: 2)->nullable();
            $table->longText("payload")->nullable();
            $table->string("status")->nullable();
            $table->string("date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_sells');
    }
};
