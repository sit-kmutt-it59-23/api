<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;
use Faker\Generator as Faker;

use App\Models\Role;
use App\Models\User;
use App\Models\UserDatum;


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
        'username' => $faker->userName,
        'password' => bcrypt('1234'),
    ];
})->afterCreating(User::class, function ($user, Faker $faker) {
    $username = $user->username;
    $user->user_datum()->create(factory(UserDatum::class)->make([
        'student_id' => is_numeric($username) && strlen($username) == 11 ? $username : null
    ])->toArray());
});

$factory->afterCreatingState(User::class, 'admin', function ($user, Faker $faker) {
    $user->attachRole(Role::where('name', 'admin')->first());
});

$factory->afterCreatingState(User::class, 'president_vice_activity', function ($user, Faker $faker) {
    $user->attachRole(Role::where('name', 'president_vice_activity')->first());
});

$factory->afterCreatingState(User::class, 'personel_stdaffair', function ($user, Faker $faker) {
    $user->attachRole(Role::where('name', 'personel_stdaffair')->first());
});

$factory->afterCreatingState(User::class, 'personel', function ($user, Faker $faker) {
    $user->attachRole(Role::where('name', 'personel')->first());
});

$factory->afterCreatingState(User::class, 'lecturer', function ($user, Faker $faker) {
    $user->attachRole(Role::where('name', 'lecturer')->first());
});

$factory->state(User::class, 'student', [
    'username' => function () {
        return randomStudentNo();
    }
])->afterCreatingState(User::class, 'student', function ($user, Faker $faker) {
    $user->attachRole(Role::where('name', 'student')->first());
});

function randomStudentNo() {
    $faker = FakerFactory::create();

    $yearBeTwoDigit = (Carbon::now()->year + 543) % 100;
    $stdno = str_pad($faker->numberBetween($yearBeTwoDigit - 5, $yearBeTwoDigit - 1), 2, 0, STR_PAD_LEFT);
    $stdno .= "99";
    $stdno .= "05";
    $stdno .= str_pad($faker->randomNumber(5), 5, 0, STR_PAD_LEFT);

    return $stdno;
}