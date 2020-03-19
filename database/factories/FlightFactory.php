<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Flight;
use Faker\Generator as Faker;

$factory->define(Flight::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'age' => $faker->biasedNumberBetween(1,  100),
        'destination_id' => $faker->biasedNumberBetween(1, 10),
    ];
});
