<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScenarioActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenario_actions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('device_property_id');

            $table->string('name');
            $table->text('description')->nullable();

            $table->text('action');

            $table->foreign('device_property_id')
                ->references('id')->on('device_properties')
                ->onDelete('cascade');

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
        Schema::dropIfExists('scenario_actions');
    }
}
