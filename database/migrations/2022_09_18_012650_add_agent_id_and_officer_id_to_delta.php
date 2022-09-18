<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgentIdAndOfficerIdToDelta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delta', function (Blueprint $table) {
            $table->bigInteger('agent_id')->after('media');
            $table->bigInteger('officer_id')->after('media');
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
            $table->dropColumn('agent_id');
            $table->dropColumn('officer_id');
        });
    }
}
