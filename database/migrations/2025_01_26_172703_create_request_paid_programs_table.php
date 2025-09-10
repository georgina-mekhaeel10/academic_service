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
        Schema::create('request_paid_programs', function (Blueprint $table) {
            $table->id(); // إنشاء حقل مفتاح أساسي
            $table->unsignedBigInteger('student_id'); // المفتاح الخارجي للطالب
            $table->string('student_name'); // اسم الطالب
            $table->unsignedBigInteger('paid_program_id'); // المفتاح الخارجي للبرنامج المدفوع
            $table->string('paid_program_name'); // اسم البرنامج المدفوع
            $table->date('application_date')->default(now()); // تاريخ التقديم
            $table->enum('type', ['master', 'university', 'phd']); // نوع البرنامج (اختياري)
            $table->timestamps(); // الطوابع الزمنية

            // العلاقات
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('paid_program_id')->references('id')->on('paidprograms')->onDelete('cascade');
      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_paid_programs');
    }
};
