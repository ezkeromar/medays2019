<?php

use App\Models\Hotel;
use App\Models\ParticipantFeature;
use App\Models\ParticipantType;
use App\Models\Restaurant;
use App\Models\RoomCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $hotels = Config::get('meDays.hotels');

        Hotel::insert($hotels);

        $room_categories = Config::get('meDays.room_categories');

        RoomCategory::insert($room_categories);

        $restorations = Config::get('meDays.restorations');

        Restaurant::insert($restorations);

        $types = Config::get('meDays.participant.types');

        ParticipantType::insert($types);

        // factory(App\Models\Participants::class, 50)->create()->each(function ($participant) {
        //     // $participant->posts()->save(factory(App\Post::class)->make());
        // });
    }
}
