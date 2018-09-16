<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
    	'post_type' => $faker->randomElement(['formation', 'stage']),
        'title' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'start_date' => $faker->dateTime(),
        'end_date' => $faker->dateTime('1575936000'),
        'price' => $faker->numberBetween(10, 30),
        'max_students' => $faker->numberBetween(30, 40)
    ];
});
