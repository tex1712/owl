<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAndResultToDelta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delta', function (Blueprint $table) {
            $table->boolean('status')->after('direction_id');
            $table->boolean('result')->after('direction_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delta', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('result');
        });
    }
}
