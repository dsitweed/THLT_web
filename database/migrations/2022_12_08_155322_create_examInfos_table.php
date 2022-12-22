<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examInfos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('teacher_id')->constrained('Teachers');
            $table->foreignId('course_id')->constrained('Courses');
            $table->integer('question_lenth');
            $table->string('time');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examInfos');
    }
};
