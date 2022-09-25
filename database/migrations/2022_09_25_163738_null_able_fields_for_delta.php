<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullAbleFieldsForDelta extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE delta MODIFY `civil` ENUM('0', '1')");
        DB::statement("ALTER TABLE delta MODIFY `correction` ENUM('0', '1')");
        DB::statement("ALTER TABLE delta MODIFY `specific` ENUM('p','i','d')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE delta MODIFY `civil` ENUM(0, 1) NOT NULL");
        DB::statement("ALTER TABLE delta MODIFY `correction` ENUM(0, 1) NOT NULL");
        DB::statement("ALTER TABLE delta MODIFY `specific` ENUM('p','i','d') NOT NULL");
    }
}
