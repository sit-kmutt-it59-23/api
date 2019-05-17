<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\UserDatum;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') == 'local') {
            factory(User::class)->state('admin')->create([
                'username' => 'admin'
            ]);

            factory(User::class)->state('president_vice_activity')->create([
                'username' => 'vicepres'
            ]);

            factory(User::class)->state('personel_stdaffair')->create([
                'username' => 'perstd'
            ]);

            factory(User::class)->state('personel')->create([
                'username' => 'person'
            ]);
            
            for ($i = 1; $i <= 8; $i++) {
                factory(User::class)->state('lecturer')->create([
                    'username' => 'lecturer'. str_pad($i, 2, "0", STR_PAD_LEFT)
                ]);
            }
            
            for ($i = 1; $i <= 32; $i++) {
                factory(User::class)->state('student')->create([
                    'username' => '590099'. str_pad($i, 5, "0", STR_PAD_LEFT)
                ]);
            }
        }
    }
}
