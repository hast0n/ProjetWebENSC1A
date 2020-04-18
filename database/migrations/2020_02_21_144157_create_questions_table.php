<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Définition d'une colonne dont le type est unsigned big integer
            // avec pour nom 'user_id'
            $table->unsignedBigInteger('user_id');
            $table->text('text');
            $table->unsignedInteger('type');
            $table->timestamps();


            git add . && git commit -m "added comments" && git push heroku master && git push -u origin master

            // L'instruction suivante permet de définir une colonne
            // faisant référence à une clé étrangère

            // renseigner la colonne faisant référence à une autre colonne
            $table->foreign('user_id')
                // renseigner le nom de la colonne étrangère
                ->references('id')
                // renseigner la table dans laquelle se situe cette colonne
                ->on('users')
                // définition du comportement à opter pour lors de la
                // suppression de la donnée dans la colonne référencée
                // Ici, 'cascade' signifie que lorsque l'on supprimera la donnée associée,
                // celle présente dans cette table ('questions') sera aussi supprimer
                ->onDelete('cascade');

            // Cela se traduit par : une fois que l'utilisateur est supprimé, supprimer toutes les questions
            // qui lui sont associées.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
