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
            $table->string("product_pic")->nullable;
            $table->foreignId("category_id");
            $table->foreignId("subcategory_id");
            $table->string("product_name");
            $table->foreignId("condition_id");
            $table->foreignId("option_id");
            $table->foreignId("username");
            $table->decimal("product_price");
            $table->foreignId("paymentoption_id");
            $table->foreignId("nego_id");
            $table->string("brand");
            $table->string("material");
            $table->string("more_desc")->nullable;
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
