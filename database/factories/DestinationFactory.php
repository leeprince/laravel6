<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Destination;
use Faker\Generator as Faker;

$factory->define(Destination::class, function (Faker $faker) {
    return [
        'destination_name' => $faker->address,
        'last_flight' => $faker->biasedNumberBetween(1, 10)
    ];
});
