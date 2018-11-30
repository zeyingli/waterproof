<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddLatToKiosk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kiosk', function ($table) {
            $table->string('lat')->nullable()->after('location');
            $table->string('lng')->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('lat');
        $table->dropColumn('lng');
    }
}
