<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicePropertiesRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_property_room', function (Blueprint $table) {
            $table->uuid('device_property_id');
            $table->uuid('room_id');

            $table->unique(['device_property_id', 'room_id']);

            $table->foreign('device_property_id')
                ->references('id')
                ->on('device_properties')
                ->onDelete('cascade');

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_property_room');
    }
}
