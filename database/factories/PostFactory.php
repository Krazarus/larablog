<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'title' => $faker->sentence,
        'thumbnail' => $faker->image('public/images', $width = 640, $height = 480),
        'body' => $faker->text($maxNbChars = 800)
    ];
});
