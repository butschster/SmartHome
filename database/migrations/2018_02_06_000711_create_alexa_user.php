<?php

use SmartHome\Domain\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;

class CreateAlexaUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::create([
            'name' => 'Alexa',
            'email' => 'alexa@butschsterhome.ru',
            'password' => bcrypt('secret')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
