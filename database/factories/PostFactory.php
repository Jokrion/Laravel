<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
    	'post_type' => $faker->randomElement(['formation', 'stage']),
        'title' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'start_date' => new Carbon(),
        'end_date' => new Carbon('first day of october 2018'),
        'price' => $faker->numberBetween(10, 30),
        'max_students' => $faker->numberBetween(30, 40),
        'status' => 'published'
    ];
});
