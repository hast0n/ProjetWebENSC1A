<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'user_id' =>  App\User::all()->random()->id,
//        'name' => $faker->regexify('[A-Za-z0-9]{6}'),
        'name' => DatabaseSeeder::readable_random_string($faker->numberBetween(3, 16)),
        'short_description' => $faker->realText()
    ];
});
