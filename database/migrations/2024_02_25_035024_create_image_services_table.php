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
        Schema::create('image_services', function (Blueprint $table) {
            $table->id();
            $table->string('img400x800')->nullable();
            $table->string('img400x400')->nullable();
            $table->string('img800x800')->nullable();
            $table->string('img800x400')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_services');
    }
};