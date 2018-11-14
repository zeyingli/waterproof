<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTableForUmbrella extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umbrella', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kiosk_id')->unsigned()->index();
            $table->foreign('kiosk_id')->references('id')->on('kiosk')->onDelete('cascade');
            $table->tinyInteger('status')->unsigned();
            $table->text('url')->nullable();
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
        Schema::dropIfExists('umbrella');
    }
}
