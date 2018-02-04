<?php

use App\Entities\Room;
use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::truncate();

        $rooms = [
            'Зал', 'Кухня', 'Спальня', 'Туалет', 'Ванна', 'Балкон', "Детская", "Прихожая"
        ];
        
        foreach ($rooms as $room) {
            Room::create([
                'name' => $room
            ]);
        }
    }
}
