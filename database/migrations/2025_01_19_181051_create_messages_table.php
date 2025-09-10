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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('support_id')->nullable();
            $table->unsignedBigInteger('reply_to_message_id')->nullable(); // لتحديد إذا كانت الرسالة ردًا على رسالة أخرى
            $table->text('message');
            $table->boolean('is_support')->default(false); // لتحديد ما إذا كانت الرسالة من الدعم
            $table->timestamps();
    
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('support_id')->references('id')->on('a_supports')->onDelete('cascade');
            $table->foreign('reply_to_message_id')->references('id')->on('messages')->onDelete('cascade'); // ربط الردود بالرسائل الأصلية
        });
     
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
