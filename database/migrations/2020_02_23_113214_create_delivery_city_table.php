<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_city', function (Blueprint $table) {
            $table->BigIncrements('id');

            $table->bigInteger('id_city')->unsigned()->index();
            
            $table->bigInteger('id_time')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('delivery_city', function (Blueprint $table) {
            $table->foreign('id_time')->references('id_time')->on('delivery_times')->onDelete('cascade');
        });

        Schema::table('delivery_city', function (Blueprint $table) {
            $table->foreign('id_city')->references('id_city')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_city');
    }
}
