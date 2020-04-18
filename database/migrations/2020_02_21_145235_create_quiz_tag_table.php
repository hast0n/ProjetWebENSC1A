<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('quiz_id');
            $table->unsignedBigInteger('tag_id');

            // double renseignement de clé étrangère,
            // cette table sera une table pivot
            $table->foreign('quiz_id')
                ->references('id')
                ->on('quizzes')
                ->onDelete('cascade');

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');

            // Définition d'une clé primaire composée des colonnes 'quiz_id' et 'tag_id'
            $table->primary(['quiz_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_tag');
    }
}
