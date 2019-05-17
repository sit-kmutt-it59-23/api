<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Factory as FakerFactory;
use Faker\Generator as Faker;

use App\Models\User;
use App\Models\UserDatum;

$fakerTh = FakerFactory::create("th_TH");

$factory->define(UserDatum::class, function (Faker $faker) use ($fakerTh) {
    return [
        'first_name' => $faker->firstName,
        'middle_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'tel_no' => str_replace(' ', '', $fakerTh->mobileNumber),
    ];
});
