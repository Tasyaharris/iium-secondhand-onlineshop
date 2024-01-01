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
        Schema::create('contact_admins', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('message');
            $table->timestamp('posted_at')->nullable;
            $table->foreignId('username');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_admins');
    }
};
