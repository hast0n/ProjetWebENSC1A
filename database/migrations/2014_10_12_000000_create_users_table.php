<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Déclaration d'une migration
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * Exécuter la migration
     *
     * @return void
     */
    public function up()
    {
        // Définition d'une nouvelle table nommée 'users'
        Schema::create('users', function (Blueprint $table) {

            // Déclaration d'une nouvelle colonne 'id' type
            // unsigned bigInteger(20) comme clé primaire par défaut
            $table->bigIncrements('id');

            // Déclaration d'une nouvelle colonne 'name' de type
            // varchar(255)
            $table->string('name');

            // Déclaration d'une nouvelle colonne 'email' de type
            // varchar(255) avec l'attribut unique qui empêchera
            // d'avoir deux entrée d'avoir la même valeur dans cette colonne
            $table->string('email')->unique();

            // Colonne fournie par défaut stockant la date de vérification
            // des emails utilisateur (non utilisé dans ce projet)
            // de type timestamp
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');

            // Déclaration d'une nouvelle colonne 'is_admin' de type boolean
            // dont la valeur par défaut est 0
            $table->boolean('is_admin')->default(0);

            // Déclaration d'une nouvelle colonne automatique permettant
            // la gestion des cookies de session pour une reconnexion rapide
            $table->rememberToken();

            // Déclaration d'une instruction intégrant 2 nouvelles colonne
            // 'created_at' et 'updated_at' de type timestamp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Annuler la migration.
     *
     * @return void
     */
    public function down()
    {
        // Instruction générée automatiquement
        // permettant de supprimer une table
        Schema::dropIfExists('users');
    }
}
