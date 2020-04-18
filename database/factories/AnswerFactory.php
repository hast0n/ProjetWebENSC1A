<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'question_id' =>  App\Question::all()->random()->id,
        'text' => $faker->realText(50),
        'is_right_answer' => $faker->boolean()
    ];
});
