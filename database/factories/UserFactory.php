<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Models\Victim::class, function (Faker $faker) {

    return [
        'full_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'district' => $faker->state ,
        'incident_place'=>$faker->city,
        'incident_time'=>$faker->amPm($max = 'now'),
        'image'=>$faker->imageUrl($width = 640, $height = 480),
        'token'=>str_random(6)
    ];
});

$factory->define(App\Models\Service::class, function (Faker $faker) {

    return [
        'service_name' => $faker->word,
        'description' => $faker->paragraph,
        'case_id' => App\Models\Victim::all()->random()->id     
    ];
});

$factory->define(App\Models\FollowUp::class, function (Faker $faker) {

    return [
        'case_id' => App\Models\Victim::all()->random()->id ,
        'description' => $faker->paragraph,
        'user_id' =>  App\User::all()->random()->id   
    ];
});
