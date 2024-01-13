<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id');
            $table->string('question');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->string('answer_1');
            $table->string('answer_2');
            $table->string('answer_3');
            $table->string('answer_4');
            $table->enum('correct_answer', ['answer_1', 'answer_2', 'answer_3', 'answer_4']);
            $table->integer('position');
            $table->timestamps();

            $table->foreign('quiz_id')->references('id')->on('quizzes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
