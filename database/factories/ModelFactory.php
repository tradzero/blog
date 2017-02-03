<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'nickname'       => $faker->name,
        'username'       => $faker->unique()->userName,
        'password'       => bcrypt(123456),
        'sex'            => rand(0, 1),
        'mail'           => $faker->safeEmail,
        'role'           => rand(1, 2), 
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    $published = $faker->dateTimeThisYear();
    return [
        'user_id' => 1,
        'title'   => $faker->sentence(mt_rand(3, 10)),
        'content' => $faker->realText($maxNbChars = 500),
        'like'    => rand(5, 50),
        'unlike'  => rand(1, 20),
        'visible' => rand(0,2),
        'created_at'     => $published,
        'updated_at'     => $published,
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    $tags = [
        '开发', '运维' , '前端', '后端', '生活', '琐事', '吐槽', '感情' 
    ];

    return [
        'name' => $faker->unique()->randomElement($tags),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => rand(1, 6),
        'post_id' => rand(1, 10),
        'comment' => $faker->sentence(),
        'like'    => rand(1, 10),
        'unlike'  => rand(0, 6)
    ];
});
