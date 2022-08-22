<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Videos;
use Faker\Generator as Faker;

$factory->define(Videos::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'description' => $faker->text,
        'filename' => $faker->word,
        'created_by' => $faker->word,
        'updated_by' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
