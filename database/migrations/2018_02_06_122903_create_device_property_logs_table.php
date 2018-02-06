<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicePropertyLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_property_logs', function (Blueprint $table) {
            $table->uuid('device_property_id')->index();
            $table->string('value')->nullable();

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
        Schema::dropIfExists('device_property_logs');
    }
}
