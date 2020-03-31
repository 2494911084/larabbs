<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reply::class, function (Faker $faker) {
    $created = $faker->dateTimeThisMonth();
    $updated = $faker->dateTimeThisMonth($created);
    return [
        'content' => $faker->sentence(),
        'created_at' => $created,
        'updated_at' => $updated,
    ];
});
