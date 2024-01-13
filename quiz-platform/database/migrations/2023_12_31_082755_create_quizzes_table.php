<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('quizzes')) {
            Schema::create('quizzes', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description');
                $table->string('main_photo')->nullable();
                $table->unsignedBigInteger('author_id');
                $table->timestamps();
            });
        }
    }    

    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
};
