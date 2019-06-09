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
        'first_name_th' => '',
        'middle_name_th' => '',
        'last_name_th' => '',
        'nationality' => 'ไทย',
        'student_id' => '',
        'study_major_code' => $faker->randomNumber(9, true),
        'score_gpa' => $faker->randomFloat(2, $min = 1.5, $max = 4),
        'activity_experience' => $faker->sentence,
        'addr_street_1' => $fakerTh->streetAddress,
        'addr_street_2' => '',
        'addr_sub_district' => $fakerTh->city,
        'addr_district' => $fakerTh->city,
        'addr_state' => $fakerTh->province,
        'addr_postal_code' => $faker->postcode,
        'addr_country' => $fakerTh->country,
        'tel_no' => str_replace(' ', '', $faker->e164PhoneNumber),
        'email' => $faker->safeEmail,
        'image_path_official' => '',
        'image_path_profile' => '',
    ];
});
