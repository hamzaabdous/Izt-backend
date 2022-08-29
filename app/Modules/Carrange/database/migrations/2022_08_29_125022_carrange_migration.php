<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarrangeMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carranges', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("Label");
            $table->integer("MinPassengers");
            $table->integer("MaxPassengers");
            $table->integer("PricePercentage");


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
