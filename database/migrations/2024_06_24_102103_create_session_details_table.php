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
        Schema::create('session_details', function (Blueprint $table) {
            $table->id();
            $table->string('session_name');
            $table->unsignedBigInteger('synagogue_id');
            $table->unsignedBigInteger('category_id');
            $table->string('session_image')->nullable();
            $table->dateTime('session_time');
            $table->string('days_of_session')->nullable();
            $table->string('instructor');
            $table->string('youtube_url')->nullable();
            $table->string('address')->nullable();
             $table->int('phone')->nullable();
            $table->string('discription')->nullable();
            $table->foreign('synagogue_id')->references('id')->on('synagogues')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('lesson_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_details');
    }
};
