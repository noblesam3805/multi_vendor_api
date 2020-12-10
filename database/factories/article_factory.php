<?php

use Faker\Generator as Faker;

$factory->define(App\article::class, function (Faker $faker) {
    return [
        'title'=>$faker->text(40),
        'body'=>$faker->text(300)
    ];
});
