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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('age');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'manager', 'hr', 'finance', 'employee','dataentry'])->default('admin');
            $table->string('mobile')->unique();
            $table->string('address');
            $table->string('jobTitle');
            $table->integer('salary');
            $table->enum('department', ['programming', 'graphics', 'Marketing','Administrative','photography','video','sales']);
            $table->enum('status', ['permanent', 'temporary', 'trainee']);
            $table->enum('gender', ['male', 'female']);
            $table->string('image');
            $table->string('image2');
            $table->string('image3');
            $table->string('creator_name')->nullable();
            // $table->foreignId('employee_id')->constrained('employees')->references('id')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
