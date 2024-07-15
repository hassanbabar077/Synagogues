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
        Schema::create('prayer_times', function (Blueprint $table) {
            $table->id();
            $table->dateTime('time');
            $table->unsignedBigInteger('prayer_category_id');
            $table->unsignedBigInteger('synagogue_id');
            $table->string('location');
            $table->string('head_person');
            $table->string('phone');
            $table->string('image')->nullable();
            $table->string('links')->nullable();
            $table->string('discription')->nullable();
            $table->string('youtube_url')->nullable();
            $table->foreign('synagogue_id')->references('id')->on('synagogues')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('prayer_category_id')->references('id')->on('prayer_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prayer_times');
    }
};
