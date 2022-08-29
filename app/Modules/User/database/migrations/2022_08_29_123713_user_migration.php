<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("username");
            $table->string("lastName");
            $table->string("firstName");
            $table->string("email");
            $table->string("password");
            $table->string("phoneNumber");
            $table->string("city");
            $table->string("codePostal");
            $table->string("genre");
            $table->string("role");
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
