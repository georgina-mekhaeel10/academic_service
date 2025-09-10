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
        Schema::create('request_scholarships', function (Blueprint $table) {
            $table->id(); // إنشاء حقل مفتاح أساسي
            $table->unsignedBigInteger('student_id'); // المفتاح الخارجي للطالب
            $table->string('student_name'); // اسم الطالب
            $table->unsignedBigInteger('scholarship_id'); // المفتاح الخارجي للمنحة
            $table->string('scholarship_name'); // اسم المنحة
            $table->date('application_date')->default(now()); // تاريخ التقديم
            $table->enum('type', ['master', 'university', 'phd']); // نوع البرنامج (اختياري)
            $table->enum('funding_type', ['Full', 'Partial']); // نوع التمويل
            $table->timestamps(); // الطوابع الزمنية

            // العلاقات
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('scholarship_id')->references('scholarships_ID')->on('scholarships')->onDelete('cascade');
     
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_scholarships');
    }
};
