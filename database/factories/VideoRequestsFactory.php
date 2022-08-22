<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\VideoRequests;
use Faker\Generator as Faker;

$factory->define(VideoRequests::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'video_id' => $faker->randomDigitNotNull,
        'verified_at' => $faker->word,
        'verifier_id' => $faker->randomDigitNotNull,
        'allowed_duration' => $faker->randomDigitNotNull,
        'created_by' => $faker->word,
        'updated_by' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
