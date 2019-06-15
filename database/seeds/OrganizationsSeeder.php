<?php

use Illuminate\Database\Seeder;

use App\Models\OrganizationCategory;
use App\Models\OrganizationType;
use App\Models\OrganizationUserLevel;

class OrganizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organization_types = [
            ['name' => 'student_council'],
            ['name' => 'student_union'],
            ['name' => 'student_club'],
            ['name' => 'student_association']
        ];
        OrganizationType::insert($organization_types);

        $organization_categories = [
            ['name' => 'art'],
            ['name' => 'academic'],
            ['name' => 'community_service'],
            ['name' => 'sport']
        ];      
        OrganizationCategory::insert($organization_categories);

        $organization_user_levels = [
            ['name' => 'advisor'], //อาจารย์ที่ปรึกษา
            ['name' => 'chairman'], //ประธาน
            ['name' => 'chairman_vice'], //รองประธาน
            ['name' => 'chairman_commission'], //ประธานคณะกรรมาธิการ
            ['name' => 'officer'], //เจ้าหน้าที่ทั่วไป
            ['name' => 'officer_treasurer'], //เหรัญญิก
            ['name' => 'officer_supply'], //พัสดุ
            ['name' => 'officer_secretary'], //เลขานุการ
            ['name' => 'officer_secretary'], //เลขานุการ
            ['name' => 'officer_quality_assurance'], //ประกันคุณภาพ
            ['name' => 'member'], //สมาชิก
        ];
        OrganizationUserLevel::insert($organization_user_levels);

        OrganizationType::where('name', 'student_council')->first()->organizations()->create([
            'name' => 'สภานักศึกษา',
            'name_en' => 'Student Council'
        ]);

        OrganizationType::where('name', 'student_union')->first()->organizations()->create([
            'name' => 'องค์การนักศึกษา',
            'name_en' => 'Student Union'
        ]);

        OrganizationType::where('name', 'student_association')->first()->organizations()->create([
            'name' => 'สโมสรนักศึกษาคณะวิศวกรรมศาสตร์',
            'name_en' => 'Student Asscociation of Faculty of Engineering'
        ]);

        OrganizationType::where('name', 'student_association')->first()->organizations()->create([
            'name' => 'สโมสรนักศึกษาคณะครุศาสตร์อุตสาหกรรมและเทคโนโลยี',
            'name_en' => 'Student Asscociation of Faculty of Industrial Education and Technology'
        ]);

        OrganizationType::where('name', 'student_association')->first()->organizations()->create([
            'name' => 'สโมสรนักศึกษาคณะวิทยาศาสตร์',
            'name_en' => 'Student Asscociation of Faculty of Science'
        ]);

        OrganizationType::where('name', 'student_association')->first()->organizations()->create([
            'name' => 'สโมสรนักศึกษาคณะสถาปัตยกรรมศาสตร์และการออกแบบ',
            'name_en' => 'Student Asscociation of School of Architecture and Design'
        ]);

        OrganizationType::where('name', 'student_association')->first()->organizations()->create([
            'name' => 'สโมสรนักศึกษาคณะเทคโนโลยีสารสนเทศ',
            'name_en' => 'Student Asscociation of School of Information Technology'
        ]);

        OrganizationType::where('name', 'student_association')->first()->organizations()->create([
            'name' => 'สโมสรนักศึกษาสถาบันวิทยาการหุ่นยนต์ภาคสนาม',
            'name_en' => 'Student Asscociation of Institute of Field Robotics'
        ]);
    }
}
