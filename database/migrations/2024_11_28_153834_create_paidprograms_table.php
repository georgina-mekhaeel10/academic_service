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
        Schema::create('paidprograms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('university_ID'); // Foreign Key (ربط بالجامعة)
            $table->string('name'); // اسم المنحة
            $table->text('description')->nullable(); // وصف المنحة
            $table->date('start_date'); // تاريخ بدء المنحة
            $table->date('end_date'); // تاريخ انتهاء المنحة
            $table->float('cost'); // تكلفة المنحة
            $table->enum('type', ['master', 'university', 'phd']); // نوع البرنامج (اختياري)
            $table->string('country'); // بلد المنحة
            $table->json('uploaded_data')->nullable(); // بيانات مرفوعة (اختياري)
            $table->string('application_url')->nullable(); // رابط التقديم
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
        Schema::dropIfExists('paidprograms');
    }
};
