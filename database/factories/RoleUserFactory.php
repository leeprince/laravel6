<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\RoleUser;
use Faker\Generator as Faker;

$factory->define(RoleUser::class, function (Faker $faker) {
    return [
        'role_id' => $faker->biasedNumberBetween(1, 10),
        'user_id' => $faker->biasedNumberBetween(1, 10),
    ];
});
