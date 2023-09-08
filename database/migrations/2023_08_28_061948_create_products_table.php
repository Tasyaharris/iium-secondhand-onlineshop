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
        Schema::create('products', function (Blueprint $table) {
            $table->id("id");
            $table->string("product_name");
            $table->foreignId("username");
            $table->string("product_pic");
            $table->decimal("product_price");
            $table->foreignId("option_id");
            $table->foreignId("category_id");
            $table->foreignId("condition_id");
            $table->string("nego_option");
            $table->string("brand");
            $table->string("material");
            $table->string("more_desc");
            $table->string("meetup_point");
            $table->timestamps();
            $table->timestamp('uploaded_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
