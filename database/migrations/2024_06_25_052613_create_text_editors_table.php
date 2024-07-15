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
        Schema::create('text_editors', function (Blueprint $table) {
            $table->id();
            $table->string('tab_main_tab');
            $table->string('tab_torah_lessons');
            $table->string('tab_synagogues');
            $table->string('tab_today_times');
            $table->string('tab_contact_us');
            $table->string('info_about_us');
            $table->string('info_share');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_editors');
    }
};
