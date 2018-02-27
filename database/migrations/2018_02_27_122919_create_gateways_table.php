<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xiaomi_gateways', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->ipAddress('ip')->unique();
            $table->string('token')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('password', 30)->nullable();

            $table->timestamps();
        });

        Schema::create('xiaomi_gateway_device', function (Blueprint $table) {
            $table->uuid('device_id');
            $table->uuid('gateway_id');

            $table->primary(['device_id', 'gateway_id']);

            $table->foreign('device_id')
                ->references('id')
                ->on('devices')
                ->onDelete('cascade');

            $table->foreign('gateway_id')
                ->references('id')
                ->on('xiaomi_gateways')
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
        Schema::dropIfExists('xiaomi_gateway_device');
        Schema::dropIfExists('xiaomi_gateways');
    }
}
