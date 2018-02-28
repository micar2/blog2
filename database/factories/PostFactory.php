<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title'     => $faker->sentence(10, true),
        'excerpt'   => $faker->sentence(100, true),
        'body'      => $faker->paragraphs(5, true),
        'published_at' => \Carbon\Carbon::parse($faker->dateTimeBetween('-2 years','+6 months')->format('Y-m-d H:i:s')),
        'category_id' => $faker->numberBetween(1,10),
        'user_id'   => $faker->numberBetween(1,50)
    ];
});
