<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Notifications;
use Faker\Generator as Faker;

$factory->define(Notifications::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'reference_type' => $faker->word,
        'reference_id' => $faker->randomDigitNotNull,
        'message' => $faker->text,
        'read_at' => $faker->date('Y-m-d H:i:s'),
        'created_by' => $faker->word,
        'updated_by' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
