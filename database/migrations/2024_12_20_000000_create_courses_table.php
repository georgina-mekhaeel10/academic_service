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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('university_ID'); // Foreign Key (ربط بالجامعة)
            $table->string('name'); // اسم الكورس
            $table->text('description')->nullable(); // وصف الكورس
            $table->date('start_date'); // تاريخ بدء الكورس
            $table->date('end_date'); // تاريخ انتهاء الكورس
            $table->decimal('cost', 10, 2)->nullable(); // تكلفة الكورس
            $table->enum('type', ['online', 'offline', 'hybrid']); // نوع الكورس
            $table->string('country'); // بلد الكورس
            $table->json('uploaded_data')->nullable(); // بيانات مرفوعة (اختياري)
            $table->string('application_url')->nullable(); // رابط التقديم
            $table->integer('duration')->nullable(); // مدة الكورس بالأسابيع
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner'); // مستوى الكورس
            $table->string('language')->default('English'); // لغة الكورس
            $table->string('instructor')->nullable(); // اسم المدرس
            $table->integer('max_students')->nullable(); // الحد الأقصى للطلاب
            $table->timestamps();

            // إضافة قيد المفتاح الأجنبي (مربوط بالجامعة)
            $table->foreign('university_ID')->references('id')->on('universities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};