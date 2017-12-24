<?php

use Faker\Generator as Faker;

$factory->define(App\Filter::class, function (Faker $faker) {
        return [
            'name' => $faker->sentence
        ];
});
