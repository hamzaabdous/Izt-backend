<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId('IdCarRange');
            $table->string("Label");
            $table->string("CarImage");

            $table->foreign('IdCarRange')->references('id')->on('carranges')
                    ->onDelete('cascade');

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
        //
    }
}
