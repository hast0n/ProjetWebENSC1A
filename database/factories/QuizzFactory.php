<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Quizz;
use Faker\Generator as Faker;

$factory->define(App\Quiz::class, function (Faker $faker) {
    return [
        'user_id' =>  App\User::all()->random()->id,
        'title' => $faker->realText(100),
        'short_description' => $faker->realText(),
        'long_description' => $faker->realText(1000),
        'difficulty_level' => $faker->numberBetween(1, 5)
    ];
});
