<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DestinationcarrangeMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinationcarranges', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("Price");


            $table->bigInteger('IdCarRange')->unsigned();
            $table->foreign('IdCarRange')->references('id')->on('carranges')
                    ->onDelete('cascade');

            $table->bigInteger('IdDepart')->unsigned();
            $table->foreign('IdDepart')->references('id')->on('destinations')
                    ->onDelete('cascade');

            $table->bigInteger('IdDestination')->unsigned();
            $table->foreign('IdDestination')->references('id')->on('destinations')

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
