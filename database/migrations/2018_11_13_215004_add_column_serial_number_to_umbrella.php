<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddColumnSerialNumberToUmbrella extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('umbrella', function ($table) {
            $table->string('serial_number')->unique()->after('kiosk_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('umbrella', function ($table) {
            $table->dropColumn('serial_number');
        });
    }
}
