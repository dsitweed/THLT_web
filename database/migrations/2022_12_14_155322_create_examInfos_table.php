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
// <<<<<<< HEAD:database/migrations/2022_12_08_155322_create_examInfos_table.php
//             $table->integer('teacher_id');
//             $table->integer('course_id');
// =======
            $table->foreignId('teacher_id')->constrained('teachers');
            $table->foreignId('course_id')->constrained('courses');
// >>>>>>> 6f44384b85eb767c52128256168c24810de3cc3b:database/migrations/2022_12_14_155322_create_examInfos_table.php
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
