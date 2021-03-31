<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Participants;
use App\Models\ParticipantType;
use Faker\Generator as Faker;

$factory->define(App\Models\Participants::class, function (Faker $faker) {
    return [
        'civility'      => $faker->randomElement([1, 2]),
        'first_name'    => $faker->firstName,
        'last_name'     => $faker->lastName,
        'birthday'      => $faker->dateTimeBetween('-80 years', '30 years'),
        'function'      => $faker->jobTitle,
        'organization'  => $faker->company,
        'nationality'   => $faker->country,
        'country'       => $faker->country,
        'city'          => $faker->city,
        'email'         => $faker->email,
        'level'         => $faker->numberBetween(1, 3),
        'type_id'       => ParticipantType::inRandomOrder()->first()->id,
        'identity_type' => $faker->randomElement([1, 2]),
        'num_identity'  => $faker->postcode,
        'pro_phone'     => $faker->phoneNumber,
        'mobile_phone'  => $faker->phoneNumber,
        'webcode'       => $faker->randomNumber(6),
        'access_code'   => $faker->randomNumber(6),
        'status'        => 1,
        'has_restoration'   => $faker->boolean,
        'has_hebergement'   => $faker->boolean,
        'has_transfert'     => $faker->boolean,
        'has_pec'           => $faker->boolean,
        'language'      => $faker->randomElement(['ar', 'fr']),
        //  'parent_id' => $faker->randomElement([null, Participants::inRandomOrder()->first()->id]),
    ];
});
