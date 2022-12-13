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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('question_id')->constrained('questions');
            $table->foreignId('exam_id')->constrained('examInfos');
            $table->foreignId('result_id')->constrained('results');
            $table->string('given_answer');

            // cách thiết lập khóa ngoài theo cách cũ 
            // $table->foreign('stu_id')->references('id')->on('students');
            
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
        Schema::dropIfExists('answers');
    }
};
