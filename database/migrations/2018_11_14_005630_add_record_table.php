<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('kiosk_id')->unsigned()->index();
            $table->foreign('kiosk_id')->references('id')->on('kiosk');
            $table->string('return_kiosk')->after('kiosk_id')->nullable();
            $table->integer('umbrella_id')->unsigned()->index();
            $table->foreign('umbrella_id')->references('id')->on('umbrella');
            $table->datetime('start_time')->nullable();
            $table->datetime('end_time')->nullable();
            $table->tinyInteger('status')->unsigned()->default('0');
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
        Schema::dropIfExist('record');
    }
}
