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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('event_text');
            $table->string('header_logo');
            $table->string('footer_logo');
            $table->string('contact');
            $table->string('copyright');
            $table->string('footer_text');
            $table->string('address');
            $table->string('facebook');
            $table->string('messenger');
            $table->string('whatsapp');
            $table->string('arrival_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
