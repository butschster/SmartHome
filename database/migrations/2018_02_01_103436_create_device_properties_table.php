<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_properties', function (Blueprint $table) {
            $table->uuid('id');

            $table->uuid('device_id');
            $table->string('key');
            $table->string('value');

            $table->string('name')->nullable();
            $table->text('description')->nullable();

            $table->unique(['device_id', 'key']);

            $table->foreign('device_id')
                ->references('id')->on('devices')
                ->onDelete('cascade');

            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_properties');
    }
}
