<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    ];
});

$factory->define(\App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6),
        'content' => $faker->paragraph(3),
    ];

});

$factory->define(\App\Topic::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];

});

$factory->define(\App\PostTopic::class, function (Faker $faker) {
    return [
        'post_id' => $faker->randomNumber(),
        'topic_id' => $faker->randomNumber(),
    ];

});
