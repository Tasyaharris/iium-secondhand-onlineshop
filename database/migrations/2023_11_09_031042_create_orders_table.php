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
        Schema::create('orders', function (Blueprint $table) {
            $table->id("id");
            $table->foreignId("username");
            $table->foreignId("product_id");
            $table->date("order_date");
            $table->decimal('total_price', 10, 2)->nullable();
            $table->foreignId("paymentoption_id");
            $table->foreignId("paymentstatus_id");
            $table->foreignId("productstatus_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
