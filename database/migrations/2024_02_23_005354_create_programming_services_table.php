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
        Schema::create('programming_services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('descriptions');
            // $table->enum('department', ['Personal Websites', 'E-commerce Websites', 'News Websites', 'Entertainment Websites', 'Social Media Websites', 'Blogs','Government Websites' , 'E-learning Websites' , 'Video Sharing Websites' , 'Travel Websites' ,'Health Websites' , 'Company System' ,'Resturent System']);
            $table->string('image')->nullable();
            // $table->string('url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programming_services');
    }
};