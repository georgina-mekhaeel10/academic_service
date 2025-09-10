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
        Schema::create('a_supports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('admin_id')->nullable(); // مفتاح أجنبي يربط بالـ Admin
            $table->foreign('admin_id') // إعداد المفتاح الأجنبي
                  ->references('id')->on('admins') // الربط مع جدول admins
                  ->onDelete('set null'); // عند حذف الـ admin يصبح NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('a_supports')) {
            Schema::table('a_supports', function (Blueprint $table) {
                $table->dropForeign(['admin_id']);
            });
        }
        Schema::dropIfExists('a_supports');
    }
    
};
