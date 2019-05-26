<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Carbon\Carbon;
use Faker\Generator as Faker;

use App\Models\DocumentProject;
use App\Models\Organization;
use App\Models\DocumentProjectCategory;

$factory->define(DocumentProject::class, function (Faker $faker) {
    return [
        'organization_id' => function () {
            return Organization::inRandomOrder()->first()->id;
        },
        'category_id' => function () {
            return DocumentProjectCategory::inRandomOrder()->first()->id;
        },
        'name' => $faker->sentence(6, true),
        'name_en' => $faker->sentence(6, true),
        'budget_amount' => $faker->randomFloat(2, 1000, 100000),
        'start_at' => Carbon::now()->setTime(00,00,00),
        'end_at' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+3 months')->getTimestamp())->setTime(23,59,59)
    ];
});
