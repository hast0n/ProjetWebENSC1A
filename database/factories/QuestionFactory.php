<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'user_id' =>  App\User::all()->random()->id,
        'text' => $faker->realText(60).' ?',
        'type' => $faker->numberBetween(1, 3)
    ];
});
