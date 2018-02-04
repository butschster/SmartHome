<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeathersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weathers', function (Blueprint $table) {
            $table->uuid('id');

            $table->float('temp')->default(0);
            $table->float('humidity')->default(0)->description('Влажность');
            $table->float('pressure')->default(0)->description('Давление');
            $table->float('clouds')->default(0);
            $table->text('clouds_description');
            $table->integer('weather_id');
            $table->text('weather_description');

            $table->primary('id');
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
        Schema::dropIfExists('weathers');
    }
}
