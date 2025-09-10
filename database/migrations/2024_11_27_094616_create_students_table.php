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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // الاسم
            $table->string('email')->unique();   // البريد الإلكتروني
            $table->string('password');          // كلمة المرور
            $table->integer('age');              // العمر
            $table->string('phone');             // رقم الهاتف
            $table->enum('gender', ['male', 'female']);  // الجنس
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
