<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

use App\Models\Organization;
use App\Models\OrganizationUserLevel;
use App\Models\User;

class OrganizationUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') == 'local') {
            $organizations = Organization::with(['organization_type' => function ($query) {
                $query->where('name', '!=', 'student_club');
            }])->get();

            //Grant lecturers as advisor to each organizations
            $advisor_level = OrganizationUserLevel::where('name', 'advisor')->first();
            $advisors = User::whereHas('roles', function ($query) {
                $query->where('name', 'lecturer');
            })->get();
            foreach ($advisors as $key => $val) {
                $organization_id = $organizations[$key]->id;
                $val->organizations()->sync([$organization_id => [
                    'level_id' => $advisor_level->id,
                    'allowed_at' => Carbon::now()
                ]]);
            }

            //Grant students as chairman to each organizations
            $chairman_level = OrganizationUserLevel::where('name', 'chairman')->first();
            $students =  User::whereHas('roles', function ($query) {
                $query->where('name', 'student');
            })->doesntHave('organizations')->take(8)->get();
            foreach ($students as $key => $val) {
                $organization_id = $organizations[$key]->id;
                $val->organizations()->sync([$organization_id => [
                    'level_id' => $chairman_level->id,
                    'allowed_at' => Carbon::now()
                ]]);
            }

            //Grant students as member to each organizations
            $member_level = OrganizationUserLevel::where('name', 'member')->first();
            $students =  User::whereHas('roles', function ($query) {
                $query->where('name', 'student');
            })->doesntHave('organizations')->get();
            foreach ($students as $key => $val) {
                $organization_id = $organizations[$key % 8]->id;
                $val->organizations()->sync([$organization_id => [
                    'level_id' => $member_level->id,
                    'allowed_at' => Carbon::now()
                ]]);
            }
        }
    }
}
