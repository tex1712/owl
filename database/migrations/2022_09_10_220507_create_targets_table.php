<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->longText('location')->nullable();
            $table->foreignId('direction_id')->constrained();
            $table->boolean('status');
            $table->bigInteger('agent_id');
            $table->bigInteger('officer_id');
            $table->date('date');
            $table->time('time')->nullable();
            $table->enum('reliability', ['a', 'b', 'c', 'd', 'e', 'f']);
            $table->longText('content')->nullable();
            $table->enum('specific', ['p', 'i', 'd'])->nullable();
            $table->boolean('civil')->nullable();
            $table->boolean('correction')->nullable();
            $table->json('coordinates')->nullable();
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
        Schema::table('targets', function (Blueprint $table) {
            $table->dropForeign(['direction_id']);
            $table->dropForeign(['source_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('targets');
    }
}
