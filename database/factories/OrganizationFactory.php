<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Faker\Generator as Faker;

use App\Models\Organization;
use App\Models\OrganizationCategory;
use App\Models\OrganizationType;

$fakerTh = FakerFactory::create("th_TH");

$factory->define(Organization::class, function (Faker $faker) use ($fakerTh) {
    return [
        'name' => $fakerTh->company,
        'name_en' => $faker->company,
        'description' => $faker->realText('255'),
        'slogan' => $faker->catchPhrase,
        'is_allowed' => true,
        'allowed_at' => $faker->dateTimeBetween('-1 month', 'now'),
        'expired_at' => $faker->dateTimeBetween('-1 months', '1 months')
    ];
});

$factory->state(Organization::class, 'student_club', [
    'type_id' => OrganizationType::where('name', 'student_club')->first()->id,
    'category_id' => function () {
        return OrganizationCategory::inRandomOrder()->first()->id;
    }
]);
