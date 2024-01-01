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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('body');
            $table->string('commentable_type')->default('App\Models\ContactAdmin');
            $table->unsignedBigInteger('commentable_id')->references('id')->on('contact_admins')->onDelete('cascade');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('parent_id');
            $table->index('commentable_type');
            $table->index('commentable_id');
        });

     
    }
   
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
