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
            $table->date("order_date");
            $table->decimal("totalOrder");
            $table->foreignId("paymentoption_id");
            $table->string("paymentProof")->default("cash");
            $table->foreignId("paymentstatus_id");
            $table->foreignId("orderstatus_id");
            $table->foreignId("delivery_id");
            $table->string("del_place");
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
