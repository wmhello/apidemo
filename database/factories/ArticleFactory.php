<?php

use Faker\Generator as Faker;
use App\Article;

$factory->define(Model::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
    ];
});
