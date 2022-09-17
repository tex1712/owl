<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeltaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delta', function (Blueprint $table) {
            $table->id();
            $table->longText('location');
            $table->foreignId('direction_id')->constrained();
            $table->date('date');
            $table->time('time')->nullable();
            $table->enum('reliability', ['a', 'b', 'c', 'd', 'e', 'f']);
            $table->longText('content');
            $table->enum('specific', ['p', 'i', 'd']);
            $table->boolean('civil');
            $table->boolean('correction');
            $table->longText('coordinates');
            $table->foreignId('source_id')->constrained();
            $table->longText('media')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->softDeletes();
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
        Schema::table('delta', function (Blueprint $table) {
            $table->dropForeign(['direction_id']);
            $table->dropForeign(['source_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('delta');
    }
}
