<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesSeeder::class,
            OrganizationsSeeder::class,
            UsersSeeder::class,
            OrganizationUsersSeeder::class,
            DocumentsSeeder::class,
        ]);
    }
}
