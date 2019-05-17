<?php

use Illuminate\Database\Seeder;

use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'admin'
            ],
            [
                'name' => 'president_vice_activity'
            ],
            [
                'name' => 'personel_stdaffair'
            ],
            [
                'name' => 'personel'
            ],
            [
                'name' => 'lecturer'
            ],
            [
                'name' => 'student'
            ],
        ];

        Role::insert($data);
    }
}
