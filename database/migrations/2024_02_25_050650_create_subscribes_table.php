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
        Schema::create('subscribes', function (Blueprint $table) {
            $table->id();
            $table->date('start_data');
            $table->date('end_data');
            $table->text('notes');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('plane_service_id')->constrained('plane_services')->onDelete('cascade');
            $table->boolean('complete')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribes');
    }
};