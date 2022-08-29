<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReservationMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->integer("NbrPersons");
            $table->integer("NbrLuggage");
            $table->string("FirstName");
            $table->string("LastName");
            $table->string("Email");
            $table->string("PhoneNumber");

            $table->bigInteger('IdDestinationCarRange')->unsigned();
            $table->foreign('IdDestinationCarRange')->references('id')->on('destinationcarranges')
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
