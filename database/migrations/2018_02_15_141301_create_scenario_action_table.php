<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScenarioActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenario_action', function (Blueprint $table) {
            $table->uuid('scenario_id');
            $table->uuid('scenario_action_id');

            $table->foreign('scenario_id')
                ->references('id')->on('scenarios')
                ->onDelete('cascade');

            $table->foreign('scenario_action_id')
                ->references('id')->on('scenario_actions')
                ->onDelete('cascade');

            $table->primary(['scenario_id', 'scenario_action_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scenario_action');
    }
}
