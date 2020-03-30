<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {
    $sentence = $faker->sentence();
    $created = $faker->dateTimeThisMonth();
    $updated = $faker->dateTimeThisMonth($created);
    return [
        'title' => $sentence,
        'body' => $faker->text(),
        'excerpt' => $sentence,
        'created_at' => $created,
        'updated_at' => $updated,
    ];
});
