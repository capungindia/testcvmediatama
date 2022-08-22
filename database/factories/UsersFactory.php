<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Users;
use Faker\Generator as Faker;

$factory->define(Users::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'username' => $faker->word,
        'email' => $faker->word,
        'password' => $faker->word,
        'role' => $faker->randomElement(['Customer']),
        'created_by' => $faker->word,
        'updated_by' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
