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
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('user_type',['student','admin','teacher','parents'])->default('student');
            $table->string('admission_number')->nullable();
            $table->date('admission_date')->nullable();
            $table->string('roll_number')->nullable();
            $table->foreignId('class_model_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('gender',['male','female'])->default('male');
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->string('religion')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('image')->nullable();
            $table->string('blood_group')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
