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
        Schema::create('prayer_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
             $table->string('icon');
             $table->unsignedBigInteger('prayer_category_id');
              $table->foreign('prayer_category_id')->references('id')->on('prayer_categories')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('praye_sub_categories');
    }
};
